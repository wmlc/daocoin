<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PurchaseRepository;
use App\Http\Repositories\RedeemRepository;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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
    public function index(PurchaseRepository $PurchaseRepository)
    {
        $uid = Auth::id();
        $orderList = $PurchaseRepository->getOrderList($uid);
        return view('order', ['orderList' => $orderList]);
    }

    public function redeem(RedeemRepository $RedeemRepository){
        $uid = Auth::id();
        $redeemList = $RedeemRepository->getOrderList($uid);
        return view('redeem', ['redeemList' => $redeemList]);
    }

}
