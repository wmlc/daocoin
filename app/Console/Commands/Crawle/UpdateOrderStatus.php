<?php

namespace App\Console\Commands\Crawle;

use App\Http\Constants\Config;
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
    public function handle(PurchaseRepository $PurchaseRepository)
    {
        //
        # 获取需要查询支付状态的订单
        $orderCount = $PurchaseRepository->getSearchOrderCount();
        $pageNum = ceil($orderCount / 100);

        for ($i=1; $i<=$pageNum; $i++){
            $orderList = $PurchaseRepository->getSearchOrderByPage($i, 100);
            foreach ($orderList as $key => $val){
                $data = $PurchaseRepository->getContributionsInFo($val['primetrust_order_id']);
                if(!empty($data)){
                    $orderStatus = $PurchaseRepository->getOrderStatusByContributionsStatus($data['status']);
                    if($orderStatus != $val['order_status']){
                        $PurchaseRepository->updateOrderStatus($val['id'], $orderStatus);
                    } else {
                        # 超时失效
                        if(time() - strtotime($val['created_at']) > Config::$ORDER_EXPIRY){
                            $PurchaseRepository->updateOrderStatus($val['id'], 'nvalid');
                        }
                    }

                }
            }
        }
    }
}
