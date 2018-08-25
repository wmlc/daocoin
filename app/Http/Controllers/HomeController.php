<?php

namespace App\Http\Controllers;

use App\Http\Repositories\KycRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KycRepository $KycRepository)
    {
        $uid =Auth::id();
        # 查询订单数

        # 查询用户信息 钱数  积分数


        #  查询是否kyc验证
        $is_aml = $KycRepository->isKyc($uid);

        return view('home', ['is_aml' => $is_aml]);
    }

}
