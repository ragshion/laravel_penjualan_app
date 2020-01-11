<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Produk;
use Validator;
use Storage;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produk = Produk::paginate(5);
        $kategori = Kategori::all();
        $filterKeyword = $request->get('keyword');
        $nama_kategori = '';
        if ($filterKeyword) {
            $produk = Produk::where('nama_produk','LIKE',"%$filterKeyword%")->paginate(5);
        }

        $filter_by_kategori = $request->get('kd_kategori');
        if ($filter_by_kategori) {
            $produk = Produk::where('kd_kategori',$filter_by_kategori)->paginate(5);

            $data_kategori = Kategori::find($filter_by_kategori);
            $nama_kategori = $data_kategori->kategori;

        }
        return view('produk.index', compact('produk','kategori','nama_kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('produk.create',compact('kategori'));
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
            'nama_produk'=>'required|max:255',
            'kd_kategori'=>'required',
            'harga'=>'required|min:2|max:11',
            'gambar_produk'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validasi->fails())
        {
            return redirect()->route('produk.create')->withErrors($validasi)->withInput();
        }

        $gambar_produk = $request->file('gambar_produk');
        $extention = $gambar_produk->getClientOriginalExtension();

        if ($request->file('gambar_produk')->isValid())
        {
            $namaFoto = "produk/".date('YmdHis').'.'.$extention;
            // $uploadPath = 'public/uploads/kategori'; ketika dihosting, gunakan ini
            $uploadPath = 'public/uploads/produk';
            // di function move terdapat 2 parameter, 1 folder, 2 nama foto
            $request->file('gambar_produk')->move($uploadPath,$namaFoto);
            $data['gambar_produk'] = $namaFoto;
        }
        $data['stok'] = 0;

        Produk::create($data);

        return redirect()->route('produk.index')->with('status','Produk Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        return view('produk.edit',compact('produk','kategori'));
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
        $produk = Produk::findOrFail($id);
        $data = $request->all();

        $validasi = Validator::make($data,[
            'nama_produk'=>'required|max:255',
            'kd_kategori'=>'required',
            'harga'=>'required|min:2|max:11',
            'gambar_produk'=>'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validasi->fails())
        {
            return redirect()->route('produk.edit',[$id])->withErrors($validasi);
        }

        if ($request->hasFile('gambar_produk')) {
            if ($request->file('gambar_produk')->isValid()) {
                Storage::disk('upload')->delete($produk->gambar_produk);

                $gambar_produk = $request->file('gambar_produk');
                $extention = $gambar_produk->getClientOriginalExtension();

                $namaFoto = "produk/".date('YmdHis').'.'.$extention;
                // $uploadPath = 'public/uploads/kategori'; ketika dihosting, gunakan ini
                $uploadPath = 'public/uploads/produk';
                // di function move terdapat 2 parameter, 1 folder, 2 nama foto
                $request->file('gambar_produk')->move($uploadPath,$namaFoto);
                $data['gambar_produk'] = $namaFoto;
            }
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('status','Produk Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Produk::findOrFail($id);
        Storage::disk('upload')->delete($data->gambar_produk);
        $data->delete($data);

        return redirect()->route('produk.index')->with('status','Produk Berhasil Dihapus!');
    }
}
