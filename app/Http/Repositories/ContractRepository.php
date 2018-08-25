<?php

namespace App\Http\Repositories;

use App\Http\Constants\Config;
use App\Http\Helpers\CurlHelper;
use App\Http\Models\Kyc;

class ContractRepository
{

    public function getBalance($address){
        $api = Config::$API . '/contract/getAccountBalance?address=' . $address;
        $res = CurlHelper::http($api);
        if(!empty($res)){
            $data = json_decode($res, true);
            if($data['code'] == '200'){
                return $data['data']['account'];
            }
        }
        return 0;
    }
    /**
     * 增发代币
     * @param $money
     * @return bool|mixed
     */
    public function issueToken($money){
        $api = Config::$API . '/contract/issueToken';
        $data = [
            'money' => $money,
        ];
        $res = CurlHelper::http($api, 'POST', $data);
        if(!empty($res)){
            return json_decode($res, true);
        }
        return false;
    }

    /**
     * 转账代币
     * @param $money
     * @param $to
     * @return bool|mixed
     */
    public function transferToken($money, $to){
        $api = Config::$API . '/contract/transferToken';
        $data = [
            'money' => $money,
            'to' => $to
        ];
        $res = CurlHelper::http($api, 'POST', $data);
        if(!empty($res)){
            return json_decode($res, true);
        }
        return false;
    }

    /**
     * 销毁代币
     * @param $money
     * @return bool|mixed
     */
    public function brunToken($money){
        $api = Config::$API . '/contract/brunToken';
        $data = [
            'money' => $money,
        ];
        $res = CurlHelper::http($api, 'POST', $data);
        if(!empty($res)){
            return json_decode($res, true);
        }
        return false;
    }

    /**
     * 查询订单状态
     * @param $hashCode
     * @return bool|mixed
     */
    public function getTransactionReceipt($hashCode){
        $api = Config::$API . '/contract/getTransactionReceipt?hashCode=' . $hashCode;
        $res = CurlHelper::http($api);
        if(!empty($res)){
            return json_decode($res, true);
        }
        return false;
    }

}
