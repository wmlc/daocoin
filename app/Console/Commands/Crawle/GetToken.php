<?php

namespace App\Console\Commands\Crawle;

use App\Http\Helpers\CurlHelper;
use App\Http\Repositories\PrimetrustTokenRepository;
use Illuminate\Console\Command;

class GetToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Crawle:GetToken';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '认证token获取获取脚本';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(env('APP_TIMEZONE')); //设置中国时区
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(PrimetrustTokenRepository $PrimetrustTokenRepository)
    {
        //
        $api = 'http://13.229.70.159/auth/jwts';
        $data = [
            'email' => '1290800466@qq.com',
            'password' => '111111',
        ];
        $res = CurlHelper::http($api, 'POST', $data);
        #$res = '{"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdXRoX2lkIjoiM2E5NjA3OWEtYjUyZS00MDE4LTgxZmItNGFiZTY2YTdkOWYzIiwiZXhwIjoxNTMzODg4MzE5fQ.LuASKCRgpnDSx_Ozks6fmND5Cd0N8edE2EZRcdtGSc8"}';
        $res = json_decode($res, true);
        if(!empty($res['token'])){
            $PrimetrustTokenRepository->saveToken($res['token']);
        }
        return true;
    }
}
