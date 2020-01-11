<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pegawai;
use Validator;
use App\Http\Resources\PegawaiResource;

class PegawaiController extends Controller
{
    public function login_pegawai(Request $request)
    {
        $data = $request->all();
        $validasi = Validator::make($data,[
            'username'=>'required',
            'password'=>'required'
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status'=>FALSE,
                'message'=>$validasi->errors()
            ], 400);
        }

        $username=$data['username'];
        $password=$data['password'];

        $pegawai = Pegawai::where([
            ['username',$username],
            ['is_aktif',1]
        ])->first();

        if (is_null($pegawai)) {
            // jika pegawai tidak ada
            return response()->json([
                'status'=>FALSE,
                'message'=>'Username Tidak Ditemukan atau Belum Aktif'
            ], 200);
        }else{
            if (password_verify($password,$pegawai->password)) {
                // jika password sesuai
                return response()->json([
                    'status'=>TRUE,
                    'message'=>'Berhasil Login',
                    'pegawai'=>new PegawaiResource($pegawai)
                ], 200);
            }else{
                // jika password tidak sesuai
                return response()->json([
                    'status'=>FALSE,
                    'message'=>'Username dan Password Tidak Sesuai'
                ], 200);
            }
        }
    }
}
