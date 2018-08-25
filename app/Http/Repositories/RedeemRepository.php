<?php

namespace App\Http\Repositories;

use App\Http\Constants\Config;
use App\Http\Helpers\CurlHelper;
use App\Http\Helpers\FuntionHelper;
use App\Http\Models\Order;
use App\Http\Models\PaymentMethod;
use App\Http\Models\Redeem;


class RedeemRepository
{
    public function getOrderList($uid){
        return Redeem::query()->where(['uid' => $uid])->orderByDesc('id')->paginate(30);
    }

    public function getRedeemNumByUser($uid){
        return Redeem::query()->where(['uid' => $uid])->count();
    }

    public function getSearchOrderCount()
    {
        return Redeem::query()->where('order_status', '<>', 'overdue')->count();
    }

    public function getSearchOrderByPage($page, $pageCount)
    {
        $offset = bcmul(bcsub($page, '1', 0), $pageCount, 0);
        return Redeem::query()->where('order_status', '<>', 'overdue')->offset($offset)->limit($pageCount)->get()->toArray();
    }

    public function updateRedeemOrder($id, $data){
        return Order::query()->where(['id' => $id])->update($data);
    }

    public function updateRedeemOrderStatus($orderId, $orderStatus){
        $orderModel = Order::query()->find($orderId);
        $orderModel->order_status = $orderStatus;
        return $orderModel->save();
    }

    public function saveRedeem($redeemInfo)
    {
        $orderModel = new Redeem();
        $orderModel->uid = $redeemInfo['uid'];
        $orderModel->redeem_id = $redeemInfo['redeem_id'];
        $orderModel->redeem_status = $redeemInfo['redeem_status'];
        $orderModel->redeem_currency = $redeemInfo['redeem_currency'];
        $orderModel->redeem_amount = $redeemInfo['redeem_amount'];
        $orderModel->token_name = $redeemInfo['token_name'];
        $orderModel->token_amount = $redeemInfo['token_amount'];
        $orderModel->orderHash = $redeemInfo['orderHash'];
        $orderModel->save();
        return $orderModel->id;
    }

    public function setPaymentMethod($data)
    {
        $api = Config::$API . '/v2/payment-methods';
        $PrimetrustTokenRepository = new PrimetrustTokenRepository();
        $header = [
            'token' => $PrimetrustTokenRepository->getToken(),
        ];
        $methodData = [
            'ach-check-type' => $data['ach_check_type'],
            'bank-account-name' => $data['bank_account_name'],
            'bank-account-type' => $data['bank_account_type'],
            'bank-account-number' => $data['bank_account_number'],
            'contact-email' => $data['contact_email'],
            'contact-name' => $data['contact_name'],
            'intermediary-bank-name' => $data['intermediary_bank_name'],
            'intermediary-bank-reference' => $data['intermediary_bank_reference'],
            'payment-type' => $data['payment_type'],
            'routing-number' => $data['routing_number'],
            'swift-code' => $data['swift_code'],
            'bank-name' => $data['bank_name'],
        ];
        $res = CurlHelper::http($api, 'POST', $methodData, $header);
        if (!empty($res)) {
            $res = json_decode($res, true);
            if (isset($res['data']['id'])) {
                return $res['data']['id'];
            }
        }
        return false;
    }

    public function savePaymentMethod($uid, $data)
    {
        # 保存用户PaymentMethod信息
        # 查询用户PaymentMethod，不存在入库；存在未通过认证，更新；已存在且通过认证不操作
        $userPaymentMethod = $this->getUserPaymentMethod($uid);
        if (empty($userPaymentMethod)) {
            $model = new PaymentMethod();
        } elseif ($userPaymentMethod['payment_method_id'] == '') {
            $model = PaymentMethod::query()->find($userPaymentMethod['id']);
        } elseif ($userPaymentMethod['payment_method_id'] != '') {
            return true;
        }
        $model->uid = $uid;
        $model->ach_check_type = $data['ach_check_type'];
        $model->bank_account_name = $data['bank_account_name'];
        $model->bank_account_type = $data['bank_account_type'];
        $model->bank_account_number = $data['bank_account_number'];
        $model->contact_name = $data['contact_name'];
        $model->contact_email = $data['contact_email'];
        $model->intermediary_bank_name = $data['intermediary_bank_name'];
        $model->intermediary_bank_reference = $data['intermediary_bank_reference'];
        $model->payment_type = $data['payment_type'];
        $model->routing_number = $data['routing_number'];
        $model->swift_code = $data['swift_code'];
        $model->bank_name = $data['bank_name'];
        if ($model->save()) {
            $payment_method_id = $this->setPaymentMethod($data);
            if ($payment_method_id) {
                return PaymentMethod::query()->where(['uid' => $uid])->update(['payment_method_id' => $payment_method_id]);
            }
        }
        return false;
    }

    public function getUserPaymentMethod($uid)
    {
        return PaymentMethod::query()->where(['uid' => $uid])->first();
    }

    public function isSetPaymentMethod($uid)
    {
        $paymentMethodInfo = PaymentMethod::query()->where(['uid' => $uid])->first(['payment_method_id']);
        if (empty($paymentMethodInfo) || empty($paymentMethodInfo['payment_method_id'])) {
            return false;
        }
        return true;
    }

    public function getPaymentMethod($uid)
    {
        return PaymentMethod::query()->where(['uid' => $uid])->first();
    }

    /**
     * 让信托公司给用户支付方式id打钱， 发起赎回申请   调用第三方接口
     * @return bool
     */
    public function sendRedeemApply($money, $payment_method_id)
    {
        $api = Config::$API . '/v2/disbursements';
        $PrimetrustTokenRepository = new PrimetrustTokenRepository();
        $header = [
            'token' => $PrimetrustTokenRepository->getToken(),
        ];
        $data = [
            'account-id' => Config::$ACCOUNT_ID,
            'amount' => -$money,
            'customer-reference' => '',
            'description' => '',
            'payment-method-id' => $payment_method_id,
            'payment_method' => FuntionHelper::generate_uuid(),
        ];
        $res = CurlHelper::http($api, 'POST', $data, $header);
        $res = json_decode($res, true);
        return $res;
    }
}