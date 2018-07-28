<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FuntionHelper;
use App\Http\Repositories\EmailCodeRepository;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendEmailCode(Request $Request, EmailCodeRepository $EmailCodeRepository)
    {
        $email = $Request->input('email', '');
        if(FuntionHelper::is_email($email)){
            $data = [
                'email' => $email,
                'code' => FuntionHelper::randStr(6),
                'token' => FuntionHelper::generate_uuid(),
                'is_use' => 'no',
            ];
            if($EmailCodeRepository->saveEmailCodeLog($data)){
                dispatch(new SendEmail($data));
                exit(json_encode(['code' => 200, 'data' => $data['token']]));

            }
            exit(json_encode(['code' => 400, 'data' => 'email send error']));
        }
        exit(json_encode(['code' => 400, 'data' => 'email format error']));
    }

}
