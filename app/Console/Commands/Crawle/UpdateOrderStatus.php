<?php

namespace App\Console\Commands\Crawle;

use App\Http\Constants\Config;
use App\Http\Repositories\ContractRepository;
use App\Http\Repositories\PurchaseRepository;
use Illuminate\Console\Command;

class UpdateOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Crawle:UpdateOrderStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '更新订单状态，没5分钟轮训一次';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(env('APP_TIMEZONE')); //设置中国时区
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(PurchaseRepository $PurchaseRepository, ContractRepository $ContractRepository)
    {
        //
        # 获取需要查询支付状态的订单
        $orderCount = $PurchaseRepository->getSearchOrderCount();
        $pageNum = ceil($orderCount / 100);

        for ($i=1; $i<=$pageNum; $i++){
            $orderList = $PurchaseRepository->getSearchOrderByPage($i, 100);
            foreach ($orderList as $key => $val){
                switch ($val['order_status']){
                    case 'orderNopay':
                        $data = $PurchaseRepository->getContributionsInFo($val['primetrust_order_id']);
                        if(!empty($data)){
                            $orderStatus = $PurchaseRepository->getOrderStatusByContributionsStatus($data['status']);
                            if(!empty($orderStatus) && $orderStatus != $val['order_status']){
                                if($orderStatus == 'orderAlreadyPaid'){
                                    # 更新实际购买代币数目
                                    $updateData = [
                                        'order_amount' => $data['amount'],
                                        'token_amount' => $data['amount'],
                                        'purchase_rate' => Config::$PURCHASE_RATE,
                                        'purchase_fee' => 0,
                                        'dcp_in_return' => 0,
                                        'purchase_method' => $data['payment-type'],
                                        'order_status' => 'orderAlreadyPaid',
                                    ];
                                    $PurchaseRepository->updatePurchaseOrder($val['id'], $updateData);
                                } else {
                                    $PurchaseRepository->updateOrderStatus($val['id'], $orderStatus);
                                }
                            } else {
                                # 超时失效
                                if(time() - strtotime($val['created_at']) > Config::$ORDER_EXPIRY){
                                    $PurchaseRepository->updateOrderStatus($val['id'], 'overdue');
                                }
                            }
                        }
                        break;
                    # 已支付订单，增发代币
                    case 'orderAlreadyPaid':
                        $money = $val['token_amount'];
                        $data = $ContractRepository->issueToken($money);
                        if(!empty($data) && $data['code'] == '200'){
                            # 更新订单状态
                            $updateData = [
                                'order_status_hashcode' => $data['hashcode'],
                                'order_status' => 'issueToken',
                            ];
                            $PurchaseRepository->updatePurchaseOrder($val['id'], $updateData);
                        } else {
                            # 超时失效
                            if(time() - strtotime($val['created_at']) > Config::$ORDER_EXPIRY){
                                $PurchaseRepository->updateOrderStatus($val['id'], 'overdue');
                            }
                        }
                        break;
                    # 检查订单，增发代币是否成功
                    case 'issueToken':
                        $hashcode = $val['order_status_hashcode'];
                        $data = $ContractRepository->getTransactionReceipt($hashcode);
                        if(!empty($data) && $data['code'] == '200'){
                            # 更新订单状态
                            $updateData = [
                                'order_status' => 'issueTokenSuccess',
                            ];
                            $PurchaseRepository->updatePurchaseOrder($val['id'], $updateData);
                        } else {
                            # 超时失效
                            if(time() - strtotime($val['created_at']) > Config::$ORDER_EXPIRY){
                                $PurchaseRepository->updateOrderStatus($val['id'], 'overdue');
                            }
                        }
                        break;
                    # 以增发代币订单 给用户转币
                    case 'issueTokenSuccess':
                        $money = $val['token_amount'];
                        $to = $val['wallet_address'];
                        $data = $ContractRepository->transferToken($money, $to);
                        if(!empty($data) && $data['code'] == '200'){
                            # 更新订单状态
                            $updateData = [
                                'order_status_hashcode' => $data['hashcode'],
                                'order_status' => 'transferToken',
                            ];
                            $PurchaseRepository->updatePurchaseOrder($val['id'], $updateData);
                        } else {
                            # 超时失效
                            if(time() - strtotime($val['created_at']) > Config::$ORDER_EXPIRY){
                                $PurchaseRepository->updateOrderStatus($val['id'], 'overdue');
                            }
                        }
                        break;

                    # 检查转账订单状态
                    case 'transferToken':
                        $hashcode = $val['order_status_hashcode'];
                        $data = $ContractRepository->getTransactionReceipt($hashcode);
                        if(!empty($data) && $data['code'] == '200'){
                            # 更新订单状态
                            $updateData = [
                                'order_status' => 'transferTokenSuccess',
                            ];
                            $PurchaseRepository->updatePurchaseOrder($val['id'], $updateData);
                        } else {
                            # 超时失效
                            if(time() - strtotime($val['created_at']) > Config::$ORDER_EXPIRY){
                                $PurchaseRepository->updateOrderStatus($val['id'], 'overdue');
                            }
                        }
                        break;
                }
            }
        }
    }
}
