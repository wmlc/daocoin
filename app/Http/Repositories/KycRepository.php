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
        $res = json_decode($res);
        var_dump($res);
        if($res['data']){
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
        $authData = [
            'account-id' => 123,
            'type' => 123,
            'date_of_birth' => '',
            'email' => '',
            'sex' => '',
            'type_address' => '',
            'street_1' => '',
            'city' => '',
            'region' => '',
            'postal_code' => '',
            'country' => '',
            'primary-phone-number' => '',
        ];
        if($this->auth($authData)){
            # 查询用户状态，不存在入库；存在未通过认证，更新；已存在且通过认证不操作
            $userKycInfo = Kyc::query()->where(['uid' => $uid])->first(['is_pass', 'id']);
            if(empty($userKycInfo)){
                $model = new Kyc();
                $model->nationality = $uid;
                $model->first_name = $uid;
                $model->middle_name = $uid;
                $model->family_name = $uid;
                $model->birth = $uid;
                $model->certificate_type = $uid;
                $model->certificate_id = $uid;
                $model->certificate_expiry_date = $uid;
                $model->address = $uid;
                $model->certificate = $uid;
                $model->proof_address = $uid;
                $model->is_pass = $uid;
                $model->uid = 1;
                $model->save();
            } elseif ($userKycInfo['is_pass'] != 'yes'){
                $model = Kyc::query()->find($userKycInfo['id']);
                $model->nationality = $uid;
                $model->first_name = $uid;
                $model->middle_name = $uid;
                $model->family_name = $uid;
                $model->birth = $uid;
                $model->certificate_type = $uid;
                $model->certificate_id = $uid;
                $model->certificate_expiry_date = $uid;
                $model->address = $uid;
                $model->certificate = $uid;
                $model->proof_address = $uid;
                $model->is_pass = $uid;
                $model->uid = 1;
                $model->save();
            }
        }

        return true;

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
