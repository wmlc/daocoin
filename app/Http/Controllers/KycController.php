<?php

namespace App\Http\Controllers;

use App\Http\Repositories\KycRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KycController extends Controller
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
    public function index(KycRepository $KycRepository)
    {
        $uid = Auth::id();
        $kycInfo = $KycRepository->getKycInfo($uid);
        if(!empty($kycInfo) && $kycInfo['is_pass'] == 'yes'){
            return view('kycSuccess');
        }
        return view('kyc', ['kycInfo' => $kycInfo]);
    }

    public function save(Request $Request, KycRepository $KycRepository)
    {
        $validatedData = $Request->validate([
            'type' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'familyname' => 'required',
            'gender' => 'required',
            'birth' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'type_address' => 'required',
            'country' => 'required',
            'region' => 'required',
            'city' => 'required',
            'street' => 'required',
            'postalcode' => 'required',
            'certificate_type' => 'required',
            'id_number' => 'required',
            'id_expire_date' => 'required',
            'residential_address' => 'required',
            'id_img' => 'required|image',
            'id_back_img' => 'required|image',
            'id_person_img' => 'required|image',
        ]);

        $file = $Request->file('id_img');
        if ($file->isValid()) {
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            $path = $file->storeAs('uploads', $filename);
            $validatedData['id_img'] = $path;
        }

        $file = $Request->file('id_back_img');
        if ($file->isValid()) {
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            $path = $file->storeAs('uploads', $filename);
            $validatedData['id_back_img'] = $path;
        }

        $file = $Request->file('id_person_img');
        if ($file->isValid()) {
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            $path = $file->storeAs('uploads', $filename);
            $validatedData['id_person_img'] = $path;
        }
        $uid = Auth::id();
        if($KycRepository->saveKycInfo($uid, $validatedData)){
            return view('kycSuccess');
        }
        return view('error', ['message' => 'KYC validation failed']);
    }

}
