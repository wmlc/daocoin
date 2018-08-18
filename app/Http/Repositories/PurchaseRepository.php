<?php

namespace App\Http\Repositories;

use App\Http\Constants\Config;
use App\Http\Helpers\CurlHelper;
use App\Http\Models\Order;


class PurchaseRepository
{
    /**
     * 发起铸币请求
     * @param $amount
     * @return bool
     */
    public function contributions($amount)
    {
        $api = Config::$API . '/v2/contributions';
        $data = [
            'account-id' => Config::$ACCOUNT_ID,
            'amount' => $amount,
            'contact-email' => Config::$ACCOUNT_EMAIL,
            'contact-name' => Config::$ACCOUNT_NAME,
            'payment-type' => 'wire',
        ];
        $PrimetrustTokenRepository = new PrimetrustTokenRepository();
        $header = [
            'token' => $PrimetrustTokenRepository->getToken(),
        ];
        $res = CurlHelper::http($api, 'POST', $data, $header);
        $res = json_decode($res, true);
        if(!empty($res['data'])){
            return $res['data'];
        }
        return false;
    }

    public function saveOrder($orderInfo){
        $orderModel = new Order();
        $orderModel->uid = $orderInfo['uid'];
        $orderModel->order_id = $orderInfo['order_id'];
        $orderModel->memo_code = $orderInfo['memo_code'];
        $orderModel->order_status = $orderInfo['order_status'];
        $orderModel->order_currency = $orderInfo['order_currency'];
        $orderModel->order_amount = $orderInfo['order_amount'];
        $orderModel->token_name = $orderInfo['token_name'];
        $orderModel->token_amount = $orderInfo['token_amount'];
        $orderModel->wallet_address = $orderInfo['wallet_address'];
        $orderModel->purchase_fee = $orderInfo['purchase_fee'];
        $orderModel->purchase_rate = $orderInfo['purchase_rate'];
        $orderModel->dcp_in_return = $orderInfo['dcp_in_return'];
        $orderModel->purchase_method = $orderInfo['purchase_method'];
        $orderModel->save();
        return $orderModel->id;
    }
}