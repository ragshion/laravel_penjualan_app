<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use Validator;
use Storage;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kategori = Kategori::paginate(5);
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $kategori = Kategori::where('kategori','LIKE',"%$filterKeyword%")->paginate(5);
        }
        return view('kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
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
            'kategori'=>'required|max:255',
            'gambar_kategori'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validasi->fails())
        {
            return redirect()->route('kategori.create')->withErrors($validasi)->withInput();
        }

        $gambar_kategori = $request->file('gambar_kategori');
        $extention = $gambar_kategori->getClientOriginalExtension();

        if ($request->file('gambar_kategori')->isValid())
        {
            $namaFoto = "kategori/".date('YmdHis').'.'.$extention;
            $uploadPath = 'public/uploads/kategori';
            // $uploadPath = 'uploads/kategori';
            // di function move terdapat 2 parameter, 1 folder, 2 nama foto
            $request->file('gambar_kategori')->move($uploadPath,$namaFoto);
            $data['gambar_kategori'] = $namaFoto;
        }

        Kategori::create($data);

        return redirect()->route('kategori.index')->with('status','Data Kategori Berhasil Disimpan');
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
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit',compact('kategori'));
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
        $kategori = Kategori::findOrFail($id);
        $data = $request->all();

        $validasi = Validator::make($data,[
            'kategori'=>'required|max:255',
            'gambar_kategori'=>'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validasi->fails())
        {
            return redirect()->route('kategori.edit',[$id])->withErrors($validasi);
        }

        if ($request->hasFile('gambar_kategori')) {
            if ($request->file('gambar_kategori')->isValid()) {
                Storage::disk('upload')->delete($kategori->gambar_kategori);

                $gambar_kategori = $request->file('gambar_kategori');
                $extention = $gambar_kategori->getClientOriginalExtension();

                $namaFoto = "kategori/".date('YmdHis').'.'.$extention;
                $uploadPath = 'public/uploads/kategori';
                // $uploadPath = 'uploads/kategori';
                // di function move terdapat 2 parameter, 1 folder, 2 nama foto
                $request->file('gambar_kategori')->move($uploadPath,$namaFoto);
                $data['gambar_kategori'] = $namaFoto;
            }
        }

        $kategori->update($data);

        return redirect()->route('kategori.index')->with('status','Data Kategori Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kategori::findOrFail($id);
        Storage::disk('upload')->delete($data->gambar_kategori);
        $data->delete($data);

        return redirect()->route('kategori.index')->with('status','Data Kategori Berhasil Dihapus!');
    }
}
