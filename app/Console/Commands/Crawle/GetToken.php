<?php

namespace App\Console\Commands\Crawle;

use App\Http\Constants\Config;
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
    protected $description = '认证token获取获取脚本,token两周过期';

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
        $api = Config::$API . '/auth/jwts';
        $data = [
            'email' => Config::$ACCOUNT_EMAIL,
            'password' => Config::$ACCOUNT_PASSWD,
        ];
        $res = CurlHelper::http($api, 'POST', $data);
        $res = json_decode($res, true);
        if(!empty($res['token'])){
            $PrimetrustTokenRepository->saveToken($res['token']);
        }
        return true;
    }
}
