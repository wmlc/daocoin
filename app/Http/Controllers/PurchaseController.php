<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FuntionHelper;
use App\Http\Repositories\KycRepository;
use App\Http\Repositories\PurchaseRepository;
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
        return view('contributions', ['walletAddress' => $walletAddress]);
    }

    public function doBuy(Request $Request,
                          PurchaseRepository $PurchaseRepository){

        $validatedData = $Request->validate([
            'walletAddress' => ['required', new EthAddress],
            'amount' => 'required|numeric',
        ]);

        $orderInfo = [
            'uid' => Auth::id(),
            'order_id' => date('YmdHis') . Auth::id() . FuntionHelper::randStr(10),
            'memo_code' => '',
            'order_status' => 'start',
            'order_currency' => 'USDD',
            'order_amount' => $validatedData['amount'],
            'token_name' => 'USDD',
            'token_amount' => '',
            'wallet_address' => $validatedData['walletAddress'],
            'purchase_fee' => '',
            'purchase_rate' => '',
            'dcp_in_return' => '',
            'purchase_method' => '',
            'primetrust_order_id' => '',
        ];
        # 保存订单信息
        $orderId = $PurchaseRepository->saveOrder($orderInfo);
        if($orderId){
            # 铸币订单发送
            $data = $PurchaseRepository->contributions($validatedData['amount']);
            if(empty($data)){
                return view('error', ['message' => 'Mint failure.']);
            } else {
                # 更新订单状态
                $orderInfo = [
                    'primetrust_order_id' => $data['id'],
                    'order_status' => $PurchaseRepository->getOrderStatusByContributionsStatus($data['attributes']['status']),
                    'mem_code' => $data['attributes']['reference-number'],
                ];
                if($PurchaseRepository->updateOrder($orderId, $orderInfo)){
                    return view('docontributions', ['memo_code' => $orderInfo['mem_code']]);
                }
                return view('error', ['message' => 'Mint failure.']);
            }
        }
        return view('error', ['message' => 'The order preservation failed.']);
    }

}
