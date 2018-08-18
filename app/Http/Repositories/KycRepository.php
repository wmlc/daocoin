<?php

namespace App\Http\Repositories;

use App\Http\Constants\Config;
use App\Http\Helpers\CurlHelper;
use App\Http\Models\Kyc;

class KycRepository
{
    /**
     * kyc验证
     * @param $data
     * @return bool
     */
    public function auth($data)
    {
        $api = Config::$API . '/v2/contacts';
        $PrimetrustTokenRepository = new PrimetrustTokenRepository();
        $header = [
            'token' => $PrimetrustTokenRepository->getToken(),
        ];
        $res = CurlHelper::http($api, 'POST', $data, $header);
        $res = json_decode($res, true);
        if(isset($res['data']) && $res['data']['attributes']['aml-cleared']){
            return true;
        }
        return false;
    }

    /**
     * 保存kyc验证信息
     * @param $uid
     * @param $data
     * @return bool
     */
    public function saveKycInfo($uid, $data)
    {
        # 保存用户kyc信息
        # 查询用户状态，不存在入库；存在未通过认证，更新；已存在且通过认证不操作
        $userKycInfo = Kyc::query()->where(['uid' => $uid])->first(['is_pass', 'id']);
        if(empty($userKycInfo)){
            $model = new Kyc();
        } elseif ($userKycInfo['is_pass'] != 'yes'){
            $model = Kyc::query()->find($userKycInfo['id']);
        } elseif ($userKycInfo['is_pass'] == 'yes'){
            return true;
        }
        $model->first_name = $data['firstname'];
        $model->middle_name = $data['middlename'];
        $model->family_name = $data['familyname'];
        $model->birth = $data['birth'];
        $model->certificate_type = $data['certificate_type'];
        $model->certificate_id = $data['id_number'];
        $model->certificate_expiry_date = $data['id_expire_date'];
        $model->address = $data['residential_address'];
        $model->id_img = $data['id_img'];
        $model->id_back_img = $data['id_back_img'];
        $model->id_person_img = $data['id_person_img'];
        $model->type = $data['type'];
        $model->is_pass = 'no';
        $model->uid = $uid;
        $model->gender = $data['gender'];
        $model->email = $data['email'];
        $model->phone = $data['phone'];
        $model->type_address = $data['type_address'];
        $model->country = $data['country'];
        $model->region = $data['region'];
        $model->city = $data['city'];
        $model->street = $data['street'];
        $model->postalcode = $data['postalcode'];
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


    }

    /**
     * 获取kyc验证信息
     * @param $uid
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function getKycInfo($uid)
    {
        return Kyc::query()->where(['uid' => $uid])->first();
    }

    /**
     * 判断用户是否通过验证
     * @param $uid
     * @return bool
     */
    public function isKyc($uid){
        $kycInfo = Kyc::query()->where(['uid' => $uid])->first(['is_pass']);
        if(empty($kycInfo) || $kycInfo['is_pass'] != 'yes'){
            return false;
        }
        return true;
    }


}
