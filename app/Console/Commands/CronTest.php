<?php

namespace App\Console\Commands;

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
                           KycRepository $KycRepository)
    {
        //
        $KycRepository->auth();
        #echo $PrimetrustTokenRepository->getToken();
    }
}
