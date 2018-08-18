<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EthAddress implements Rule
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
        if (strpos($value, '0x') !== 0) {
            return false;
        }
        if(mb_strlen($value) != 42){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The wallet address illegal.';
    }
}
