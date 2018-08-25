<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ContractRepository;
use App\Http\Repositories\KycRepository;
use App\Http\Repositories\PurchaseRepository;
use App\Http\Repositories\RedeemRepository;
use App\Http\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index(KycRepository $KycRepository,
                          RedeemRepository $RedeemRepository,
                          PurchaseRepository $PurchaseRepository,
                          ContractRepository $ContractRepository,UserRepository $UserRepository)
    {
        $uid = Auth::id();
        # 查询用户信息 钱数  积分数
        $userWallet = $UserRepository->getUserWalletAddress($uid);
        $balance = $ContractRepository->getBalance($userWallet);
        #  查询是否kyc验证
        $is_aml = $KycRepository->isKyc($uid);

        $orderNum = $RedeemRepository->getRedeemNumByUser($uid) + $PurchaseRepository->getOrderNumByUser($uid);

        return view('home', ['is_aml' => $is_aml, 'order_num' => $orderNum, 'balance' => $balance]);
    }

}
