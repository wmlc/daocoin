<?php

namespace App\Http\Controllers;

use App\Http\Repositories\KycRepository;
use App\Http\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\EthAddress;

class PurchaseController extends Controller
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

    public function buy(KycRepository $KycRepository,
                        UserRepository $UserRepository){
        $uid = Auth::id();
        # 检查用户是否通过aml验证
        $isKyc = $KycRepository->isKyc($uid);
        if(!$isKyc){
            return view('checkKyc');
        }
        # 获取用户钱包地址：
        $walletAddress = $UserRepository->getUserWalletAddress($uid);
        return view('checkKyc', ['walletAddress' => $walletAddress]);
    }

    public function doBuy(Request $Request){

        $validatedData = $Request->validate([
            'walletAddress' => ['required', new EthAddress],
            'amount' => 'required|numeric',
        ]);

        var_dump($validatedData);
        exit;

    }

}
