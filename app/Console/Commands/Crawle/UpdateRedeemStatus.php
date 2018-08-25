<?php

namespace App\Console\Commands\Crawle;

use App\Http\Constants\Config;
use App\Http\Repositories\RedeemRepository;
use App\Http\Repositories\ContractRepository;
use App\Http\Repositories\UserRepository;
use Illuminate\Console\Command;

class UpdateRedeemStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Crawle:UpdateRedeemStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '赎回订单状态更新脚本';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(RedeemRepository $RedeemRepository, ContractRepository $ContractRepository, UserRepository $UserRepository)
    {
        # 获取需要查询支付状态的订单
        $orderCount = $RedeemRepository->getSearchOrderCount();
        $pageNum = ceil($orderCount / 100);

        for ($i=1; $i<=$pageNum; $i++){
            $orderList = $RedeemRepository->getSearchOrderByPage($i, 100);
            foreach ($orderList as $key => $val){
                switch ($val['redeem_status']){
                    # 查询该订单是否已转账
                    case 'orderStart':
                        $hashcode = $val['orderHash'];
                        $data = $ContractRepository->getTransactionReceipt($hashcode);
                        if(!empty($data) && isset($data['code']) && $data['code'] == '200'){
                            # 验证转账人 和 收款人
                            $UserWalletAddress = $UserRepository->getUserWalletAddress($val['uid']);
                            if(isset($data['data']['from']) && $data['data']['from'] == $UserWalletAddress){
                                if(isset($data['data']['to']) && $data['data']['to'] == Config::$GUANFANG_WALLET){
                                    # 更新订单状态
                                    $updateData = [
                                        'redeem_amount' => $data['data']['tranferToken'],
                                        'token_amount' => $data['data']['tranferToken'],
                                        'redeem_status' => 'OrderPaid',
                                    ];
                                    $RedeemRepository->updateRedeemOrder($val['id'], $updateData);
                                }
                            }
                        } else {
                            # 超时失效
                            if(time() - strtotime($val['created_at']) > Config::$ORDER_EXPIRY){
                                $RedeemRepository->updateRedeemOrderStatus($val['id'], 'overdue');
                            }
                        }
                        break;
                    # 已转账订单，销毁代币
                    case 'OrderPaid':
                        $money = $val['token_amount'];
                        $data = $ContractRepository->brunToken($money);
                        if(!empty($data) && $data['code'] == '200'){
                            # 更新订单状态
                            $updateData = [
                                'order_status_hashcode' => $data['hashcode'],
                                'redeem_status' => 'brunToken',
                            ];
                            $RedeemRepository->updateRedeemOrder($val['id'], $updateData);
                        } else {
                            # 超时失效
                            if(time() - strtotime($val['created_at']) > Config::$ORDER_EXPIRY){
                                $RedeemRepository->updateRedeemOrderStatus($val['id'], 'overdue');
                            }
                        }
                        break;
                    # 检查代币销毁状态
                    case 'brunToken':
                        $hashcode = $val['order_status_hashcode'];
                        $data = $ContractRepository->getTransactionReceipt($hashcode);
                        if(!empty($data) && $data['code'] == '200'){
                            # 更新订单状态
                            $updateData = [
                                'redeem_status' => 'brunTokenSuccess',
                            ];
                            $RedeemRepository->updateRedeemOrder($val['id'], $updateData);
                        } else {
                            # 超时失效
                            if(time() - strtotime($val['created_at']) > Config::$ORDER_EXPIRY){
                                $RedeemRepository->updateRedeemOrderStatus($val['id'], 'overdue');
                            }
                        }
                        break;
                    # 让信托公司给用户支付方式id打钱
                    case 'brunTokenSuccess':
                        $money = $val['token_amount'];
                        $payment_method_info = $RedeemRepository->getPaymentMethod($val['uid']);
                        $payment_method_id = $payment_method_info['payment_method_id'];
                        $data = $RedeemRepository->sendRedeemApply($money, $payment_method_id);
                        if(!empty($data) && $data['code'] == '200'){
                            # 更新订单状态
                            $updateData = [
                                'redeem_status' => 'redeemStart',
                                'primetrust_redeem_id' => $data['data']['id'],
                            ];
                            $RedeemRepository->updateRedeemOrder($val['id'], $updateData);
                        } else {
                            # 超时失效
                            if(time() - strtotime($val['created_at']) > Config::$ORDER_EXPIRY){
                                $RedeemRepository->updateRedeemOrderStatus($val['id'], 'overdue');
                            }
                        }
                        break;
                }
            }
        }
    }
}
