<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FuntionHelper;
use App\Http\Repositories\KycRepository;
use App\Http\Repositories\PurchaseRepository;
use App\Http\Repositories\RedeemRepository;
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
            return view('checking_kyc');
        }
        # 获取用户钱包地址：
        $walletAddress = $UserRepository->getUserWalletAddress($uid);
        return view('application_coin', ['walletAddress' => $walletAddress]);
    }

    public function doBuy(Request $Request,
                          PurchaseRepository $PurchaseRepository,
                          UserRepository $UserRepository){

        $validatedData = $Request->validate([
            'walletAddress' => ['required', new EthAddress],
            'amount' => 'required|numeric',
        ]);
        # 更新用户绑定钱包地址
        $UserRepository->saveUserWalletAddress(Auth::id(), strtolower($validatedData['walletAddress']));

        $orderInfo = [
            'uid' => Auth::id(),
            'order_id' => date('YmdHis') . Auth::id() . FuntionHelper::randStr(10),
            'mem_code' => '',
            'order_status' => 'ordersStart',
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
                    'order_status' => 'orderNopay',
                    'mem_code' => $data['attributes']['reference-number'],
                ];
                if($PurchaseRepository->updateOrder($orderId, $orderInfo)){
                    return view('payment_method', ['mem_code' => $orderInfo['mem_code']]);
                }
                return view('error', ['message' => 'Mint failure.']);
            }
        }
        return view('error', ['message' => 'The order preservation failed.']);
    }

    public function confirmBuy(){
        return view('check_wating');
    }

    public function setPaymentMethod(Request $Request,
                                     RedeemRepository $RedeemRepository){
        $uid = Auth::id();
        if(strtolower($Request->method()) == 'get'){
            $paymentMethod = $RedeemRepository->getPaymentMethod($uid);
            return view('set_payment_method', ['paymentMethod' => $paymentMethod]);
        } else {
            $validatedData = $Request->validate([
                'ach_check_type' => 'required',
                'bank_account_name' => 'required',
                'bank_account_type' => 'required',
                'bank_account_number' => 'required',
                'contact_name' => 'required',
                'contact_email' => 'required',
                'intermediary_bank_name' => 'required',
                'intermediary_bank_reference' => 'required',
                'payment_type' => 'required',
                'routing_number' => 'required',
                'swift_code' => 'required',
                'bank_name' => 'required',
            ]);
            if($RedeemRepository->savePaymentMethod($uid, $validatedData)){
                return view('setPaymentMethodSuccess');
            }
            return view('error', ['message' => 'Please be patient and review your receiving bank information']);
        }
    }

    public function redeem(KycRepository $KycRepository, RedeemRepository $RedeemRepository){
        $uid = Auth::id();
        # 检查用户aml认证
        if(!$KycRepository->isKyc($uid)){
            return redirect('/kyc');
        }
        # 检查是否设置支付方式
        if(!$RedeemRepository->isSetPaymentMethod($uid)){
            return redirect('/setPaymentMethod');
        }
        return view('getPayMethod');
    }

    public function saveRedeemOrder(Request $Request){
        $validatedData = $Request->validate([
            'orderHash' => 'required',
        ]);





        return view('check_wating');


    }

}
