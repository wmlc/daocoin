<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class FileController extends Controller
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

    public function upload(Request $request)
    {

        if ($request->isMethod('post')) {
            $file = $request->file('picture');
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

        }

        return view('upload');
    }



}
