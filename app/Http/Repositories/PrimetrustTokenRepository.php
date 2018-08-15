<?php
namespace App\Http\Repositories;

use App\Http\Models\PrimetrustToken;

class PrimetrustTokenRepository
{
    public function saveToken($token){
        $res = PrimetrustToken::query()->find(1);
        if(empty($res)){
            $res = new PrimetrustToken();
        }
        $res->token = $token;
        $res->expiry = date('Y-m-d H:i:s', strtotime('+2 hour'));
        $res->save();
    }

    public function getToken(){
        $tokenData = PrimetrustToken::query()->find(1)->toArray();
        return $tokenData['token'];
    }

}
