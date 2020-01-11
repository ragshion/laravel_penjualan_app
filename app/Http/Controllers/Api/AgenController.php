<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AgenResource;
use App\Agen;
use Validator;
use Storage;


class AgenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AgenResource::collection(Agen::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validasi = Validator::make($data,[
            'nama_toko'=>'required|max:255',
            'nama_pemilik'=>'required|max:255',
            'alamat'=>'required|max:255',
            'latitude'=>'required|max:255',
            'longitude'=>'required|max:255',
            'gambar_toko'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($validasi->fails()){
            return response()->json([
                'status'=>FALSE,
                'message'=>$validasi->errors()
            ],400);
        }

        if ($request->file('gambar_toko')->isValid())
        {
            $gambar_toko = $request->file('gambar_toko');
            $extention = $gambar_toko->getClientOriginalExtension();
            $namaFoto = "agen/".date('YmdHis').'.'.$extention;
            // $uploadPath = 'public/uploads/agen'; ketika dihosting, gunakan ini
            $uploadPath = 'public/uploads/agen';
            // di function move terdapat 2 parameter, 1 folder, 2 nama foto
            $request->file('gambar_toko')->move($uploadPath,$namaFoto);
            $data['gambar_toko'] = $namaFoto;
        }

        if (Agen::create($data)) {
            return response()->json([
                'status'=>TRUE,
                'message'=>'Agen Berhasil Disimpan'
            ],201);
        }else{
            return response()->json([
                'status'=>FALSE,
                'message'=>'Agen Gagal Disimpan'
            ],200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agen = Agen::find($id);
        if (is_null($agen)) {
            return response()->json([
                'status'=>FALSE,
                'message'=>'Data tidak ditemukan'
            ], 404);
        }

        return new AgenResource($agen);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $agen = Agen::find($id);
        if (is_null($agen)) {
            return response()->json([
                'status'=>FALSE,
                'message'=>'Data Tidak Ditemukan'
            ], 404);
        }

        $validasi = Validator::make($data,[
            'nama_toko'=>'required|max:255',
            'nama_pemilik'=>'required|max:255',
            'alamat'=>'required|max:255',
            'latitude'=>'required|max:255',
            'longitude'=>'required|max:255',
            'gambar_toko'=>'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($validasi->fails()){
            return response()->json([
                'status'=>FALSE,
                'message'=>$validasi->errors()
            ],400);
        }

        if ($request->hasFile('gambar_toko')) {
            if ($request->file('gambar_toko')->isValid()) {
                Storage::disk('upload')->delete($agen->gambar_toko);

                $gambar_toko = $request->file('gambar_toko');
                $extention = $gambar_toko->getClientOriginalExtension();

                $namaFoto = "agen/".date('YmdHis').'.'.$extention;
                // $uploadPath = 'public/uploads/kategori'; ketika dihosting, gunakan ini
                $uploadPath = 'public/uploads/agen';
                // di function move terdapat 2 parameter, 1 folder, 2 nama foto
                $request->file('gambar_toko')->move($uploadPath,$namaFoto);
                $data['gambar_toko'] = $namaFoto;
            }
        }

        if ($agen->update($data)) {
            return response()->json([
                'status'=>TRUE,
                'message'=>'Agen Berhasil Diperbarui'
            ],200);
        }else{
            return response()->json([
                'status'=>FALSE,
                'message'=>'Agen Gagal Diperbarui'
            ],200);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agen = Agen::find($id);
        if (is_null($agen)) {
            return response()->json([
                'status'=>FALSE,
                'message'=>'Data tidak ditemukan'
            ], 404);
        }

        Storage::disk('upload')->delete($agen->gambar_toko);
        $agen->delete();
        return response()->json([
            'status'=>TRUE,
            'message'=>'Data Berhasil Dihapus!'
        ], 200);
    }

    public function search(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        return AgenResource::collection(Agen::where('nama_toko','LIKE',"%$filterKeyword%")->get());
    }
}
