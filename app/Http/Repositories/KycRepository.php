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
        var_dump($res);
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
//        `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
//  `created_at` timestamp NULL DEFAULT NULL,
//  `updated_at` timestamp NULL DEFAULT NULL,
//  `uid` int(11) NOT NULL COMMENT '用户id',
//  `nationality` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '国家',
//  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'First name',
//  `middle_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Middle name',
//  `family_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Family name',
//  `birth` date NOT NULL COMMENT '生日',
//  `certificate_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '证件类型',
//  `certificate_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '证件号',
//  `certificate_expiry_date` date NOT NULL COMMENT '证件有效期',
//  `address` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '居住地址',
//  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '证件照片',
//  `proof_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '地址证明照片',
//  `is_pass` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no' COMMENT '是否通过认证，yes|no',


 //       'type' => 'required',
//            'gender' => 'required',
//            'email' => 'required',
//            'phone' => 'required',
//            'type_address' => 'required',
//            'country' => 'required',
//            'region' => 'required',
//            'city' => 'required',
//            'street' => 'required',
//            'postalcode' => 'required',
//            'id_img' => 'required|image',
//            'id_back_img' => 'required|image',
//            'id_person_img' => 'required|image',

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
            # 查询用户状态，不存在入库；存在未通过认证，更新；已存在且通过认证不操作
            $userKycInfo = Kyc::query()->where(['uid' => $uid])->first(['is_pass', 'id']);
            if(empty($userKycInfo)){
                $model = new Kyc();
                $model->nationality = $uid;
                $model->first_name = $data['firstname'];
                $model->middle_name = $data['middlename'];
                $model->family_name = $data['familyname'];
                $model->birth = $data['birth'];
                $model->certificate_type = $data['certificate_type'];
                $model->certificate_id = $data['id_number'];
                $model->certificate_expiry_date = $data['id_expire_date'];
                $model->address = $data['residential_address'];
                $model->certificate = $uid;
                $model->proof_address = $uid;
                $model->is_pass = 'yes';
                $model->uid = $uid;
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
                $model->is_pass = 'yes';
                $model->uid = $uid;
                $model->save();
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
