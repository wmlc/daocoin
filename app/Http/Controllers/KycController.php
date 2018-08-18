<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KycController extends Controller
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
    public function index()
    {
        $id = Auth::id();
        return view('kyc');
    }

    public function save(Request $Request){
        $validatedData = $Request->validate([
//            'type' => 'required',
//            'firstname' => 'required',
//            'middlename' => 'required',
//            'familyname' => 'required',
//            'gender' => 'required',
//            'birth' => 'required',
//            'email' => 'required',
//            'phone' => 'required',
//            'type_address' => 'required',
//            'country' => 'required',
//            'region' => 'required',
//            'city' => 'required',
//            'street' => 'required',
//            'postalcode' => 'required',
//            'certificate_type' => 'required',
//            'id_number' => 'required',
//            'id_expire_date' => 'required',
//            'residential_address' => 'required',
            'id_img' => 'required',
//            'id_back_img' => 'required',
            #'id_person_img' => 'required',
        ]);

            $file = $Request->file('id_img');
            // 文件是否上传成功
            if ($file->isValid()) {
                // 获取文件相关信息
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $type = $file->getClientMimeType();     // image/jpeg
                // 上传文件
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                $path = $file->storeAs('uploads', $filename);
                var_dump($path);
            }




        exit;

    }

}
