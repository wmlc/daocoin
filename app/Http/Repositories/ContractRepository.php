<?php

namespace App\Http\Repositories;

use App\Http\Constants\Config;
use App\Http\Helpers\CurlHelper;
use App\Http\Models\Kyc;

class ContractRepository
{

    /**
     * 增发代币
     * @param $money
     * @param $to
     * @return bool|mixed
     */
    public function issueToken($money, $to){
        $api = Config::$API . '/contract/issueToken';
        $data = [
            'money' => $money,
            'to' => $to
        ];
        $res = CurlHelper::http($api, 'POST', $data);
        if(!empty($res)){

//            array(5) {
//                ["timestamp"]=>
//  string(28) "2018-08-24T00:48:49.864+0000"
//                ["status"]=>
//  int(404)
//  ["error"]=>
//  string(9) "Not Found"
//                ["message"]=>
//  string(20) "No message available"
//                ["path"]=>
//  string(20) "/contract/issueToken"
//}
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

//            array(5) {
//                ["timestamp"]=>
//  string(28) "2018-08-24T00:53:10.904+0000"
//                ["status"]=>
//  int(404)
//  ["error"]=>
//  string(9) "Not Found"
//                ["message"]=>
//  string(20) "No message available"
//                ["path"]=>
//  string(31) "/contract/getTransactionReceipt"
//}

            return json_decode($res, true);
        }
        return false;
    }

}
