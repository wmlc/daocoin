<?php

namespace App\Rules;

use App\Http\Repositories\UserRepository;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class EthAddressUnique implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $uid = Auth::id();
        $UserRepository = new UserRepository();
        $user = $UserRepository->getWalletAddressInfo($value);
        if(empty($user) || $user['uid'] == $uid){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The wallet address has been used by other users.';
    }
}
