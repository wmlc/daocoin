<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Http\Repositories\EmailCodeRepository;

class VerificationCode implements Rule
{
    public $data;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
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
        //
        if(empty($this->data['VerificationCodeToken'])){
            return false;
        }
        $EmailCodeRepository = new EmailCodeRepository();
        $emailData = $EmailCodeRepository->getEmailCodeByToken($this->data['VerificationCodeToken']);
        $signTime = time() - 600;
        if($emailData['code'] != $value || strtotime($emailData['created_at']) < $signTime || $emailData['is_use'] == 'yes' || $emailData['email'] != $this->data['email']){
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
        return 'Mailbox verification code error.';
    }
}
