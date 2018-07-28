<?php
namespace App\Http\Repositories;

use App\Http\Models\EmailCode;
use App\Http\Helpers\FuntionHelper;

class EmailCodeRepository
{
    public function saveEmailCodeLog($data){
        $EmailCode = new EmailCode();
        $EmailCode->email = $data['email'];
        $EmailCode->code = $data['code'];
        $EmailCode->token = $data['token'];
        $EmailCode->is_use = $data['is_use'];
        $EmailCode->save();
        return $EmailCode->id;
    }

    public function getEmailCodeByToken($token){
        return EmailCode::query()->where(['token' => $token])->first(['created_at', 'code', 'is_use', 'email']);
    }

}
