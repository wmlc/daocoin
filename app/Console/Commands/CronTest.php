<?php

namespace App\Console\Commands;

use App\Http\Repositories\ContractRepository;
use App\Http\Repositories\KycRepository;
use App\Http\Repositories\PrimetrustTokenRepository;
use Illuminate\Console\Command;

class CronTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CronTest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CronTest 测试脚本';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(PrimetrustTokenRepository $PrimetrustTokenRepository,
                           KycRepository $KycRepository, ContractRepository $ContractRepository)
    {
        //
//        $authData = [
//            'account-id' => '1fb2fb18-7624-44fc-a8a9-16f211dd2309',  # '1fb2fb18-7624-44fc-a8a9-16f211dd2309'
//            'type' => 'natural_person',
//            'name' => 'wangmaolin',
//            'tax-id-number' => '435345467',
//            'date_of_birth' => '1992-12-12',
//            'email' => '1290800466@qq.com',
//            'sex' => 'male',
//            'type_address' => 'home',
//            'street_1' => '1234 Example Rd',
//            'city' => 'Las Vegas',
//            'region' => 'NV',
//            'postal_code' => '89123',
//            'country' => 'CN',
//            'primary-phone-number' => '2 (624) 445-1212',
//        ];
//        $KycRepository->auth($authData);
        #var_dump($ContractRepository->issueToken());
        var_dump($ContractRepository->getTransactionReceipt('0x919200895e2796aadb1b4e99404cf9af9615155a784c6a922580dfc6c30fa86a'));
        #echo $PrimetrustTokenRepository->getBalance();
    }
}
