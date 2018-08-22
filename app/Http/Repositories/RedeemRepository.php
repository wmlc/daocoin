<?php

namespace App\Http\Repositories;

use App\Http\Constants\Config;
use App\Http\Helpers\CurlHelper;
use App\Http\Models\Order;
use App\Http\Models\PaymentMethod;


class RedeemRepository
{
    public function savePaymentMethod($uid, $data){
        # 保存用户PaymentMethod信息
        # 查询用户PaymentMethod，不存在入库；存在未通过认证，更新；已存在且通过认证不操作
        $userPaymentMethod = $this->getUserPaymentMethod($uid);
        if(empty($userPaymentMethod)){
            $model = new PaymentMethod();
        } elseif ($userPaymentMethod['payment_method_id'] == ''){
            $model = PaymentMethod::query()->find($userPaymentMethod['id']);
        } elseif ($userPaymentMethod['payment_method_id'] != ''){
            return true;
        }
        $model->ach_check_type = $data['ach_check_type'];
        $model->bank_account_name = $data['bank_account_name'];
        $model->bank_account_type = $data['bank_account_type'];
        $model->bank_account_number = $data['bank_account_number'];
        $model->contact_name = $data['contact_name'];
        $model->contact_email = $data['contact_email'];
        $model->intermediary_bank_name = $data['intermediary_bank_name'];
        $model->intermediary_bank_reference = $data['intermediary_bank_reference'];
        $model->type_address=$data['type_address'];
        $model->payment_type = $data['payment_type'];
        $model->routing_number = $data['routing_number'];
        $model->swift_code = $data['swift_code'];
        $model->bank_name = $data['bank_name'];



        if($model->save()){
            $authData = [
                'account-id' => Config::$ACCOUNT_ID,
                'type' => $data['type'],
                'date_of_birth' => $data['birth'],
                'email' => $data['email'],
                'sex' => $data['gender'],
                'type_address' => $data['type_address'],
                'street_1' => $data['street'],
                'city' => $data['city'],
                'region' => $data['region'],
                'postal_code' => $data['postalcode'],
                'country' => $data['country'],
                'primary-phone-number' => $data['phone'],
            ];
            if($this->auth($authData)){
                return Kyc::query()->where(['uid' => $uid])->update(['is_pass' => 'yes']);
            }
        }
        return false;



        $validatedData = $Request->validate([
            'ach-check-type' => 'required',
            'bank-account-name' => 'required',
            'bank-account-type' => 'required',
            'bank-account-number' => 'required',
            'contact-name' => 'required',
            'contact-email' => 'required',
            'intermediary-bank-name' => 'required',
            'intermediary-bank-reference' => 'required',
            'type_address' => 'required',
            'payment-type' => 'required',
            'routing-number' => 'required',
            'swift-code' => 'required',
            'bank-name' => 'required',
        ]);

    }

    public function getUserPaymentMethod($uid){
        return PaymentMethod::query()->where(['uid' => $uid])->first();
    }
}