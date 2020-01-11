<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use Validator;
use Illuminate\Support\Arr;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pegawai = Pegawai::paginate(5);
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $pegawai = Pegawai::where('nama_pegawai','LIKE',"%$filterKeyword%")->paginate(5);
        }
        return view('pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create');
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
            'username'=>'required|max:100|unique:pegawai',
            'nama_pegawai'=>'required|max:255|min:5',
            'alamat'=>'required|max:255|min:5',
            'jk'=>'required',
            'is_aktif'=>'required',
            'password'=>'required|min:6'
        ]);

        if ($validasi->fails())
        {
            return redirect()->route('pegawai.create')->withErrors($validasi)->withInput();
        }

        $data['password'] = bcrypt($data['password']);
        Pegawai::create($data);

        return redirect()->route('pegawai.index')->with('status','Pegawai Berhasil Ditambahkan');
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
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit',compact('pegawai'));
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
        $pegawai = Pegawai::findOrFail($id);
        $data = $request->all();

        $validasi = Validator::make($data,[
            'nama_pegawai'=>'required|max:255|min:5',
            'alamat'=>'required|max:255|min:5',
            'jk'=>'required',
            'is_aktif'=>'required'
        ]);

        if ($validasi->fails()) {
            return redirect()->route('pegawai.edit',[$id])->withErrors($validasi);
        }

        if ($data['password'])
        {
            $data['password'] = bcrypt($data['password']);
        }
        else
        {
            // jika password kosong, maka password user tidak akan diupdate
            $data = Arr::except($data,['password']);
        }

        $pegawai->update($data);

        return redirect()->route('pegawai.index')->with('status','Data Pegawai Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pegawai::findOrFail($id);
        $data->delete($data);

        return redirect()->route('pegawai.index')->with('status','Data Pegawai Berhasil Dihapus!');
    }
}
