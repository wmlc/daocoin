<?php
namespace App\Http\Repositories;

use App\Http\Models\User;
use App\Http\Models\UserProfile;

class UserRepository
{
    public function getUserWalletAddress($uid){
        $data = UserProfile::query()->where(['uid' => $uid])->first(['wallet_address']);
        return $data['wallet_address'];
    }

}
