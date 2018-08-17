<?php
namespace App\Http\Repositories;

use App\Http\Constants\Config;
use App\Http\Helpers\CurlHelper;
use App\Http\Models\PrimetrustToken;

class PrimetrustTokenRepository
{
    public function saveToken($token){
        $res = PrimetrustToken::query()->find(1);
        if(empty($res)){
            $res = new PrimetrustToken();
            $res->id = 1;
        }
        $res->token = $token;
        $res->expiry = date('Y-m-d H:i:s', strtotime('+2 week'));
        $res->save();
    }

    public function getToken(){
        $tokenData = PrimetrustToken::query()->find(1)->toArray();
        return $tokenData['token'];
    }

    public function getBalance(){
        $api = Config::$API . '/v2/accounts';
        $header = [
            'token' => $this->getToken(),
        ];
        $res = CurlHelper::http($api, 'GET', '', $header);
        $res = json_decode($res, true);
        var_dump($res);
//        if($res['data']){
//            return true;
//        }
        return false;
    }

}
