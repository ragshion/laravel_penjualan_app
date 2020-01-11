<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransaksiMasuk;
use App\Supplier;
use App\Produk;
use Validator;

class TransaksiMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaksi_masuk = TransaksiMasuk::orderBy('tgl_transaksi','desc')->paginate(5);

        if ($request->get('start_date') != '' && $request->get('end_date') != '')
        {
            $start_date = date('Y-m-d', strtotime($request->get('start_date')));
            $end_date = date('Y-m-d', strtotime($request->get('end_date')));
            $transaksi_masuk = TransaksiMasuk::whereBetween('tgl_transaksi',[$start_date,$end_date])->orderBy('tgl_transaksi','desc')->paginate(20);
            $start_date = \Carbon\Carbon::parse($start_date)->format('d F Y');
            $end_date = \Carbon\Carbon::parse($end_date)->format('d F Y');
        }

        return view('transaksi_masuk.index',compact('transaksi_masuk','start_date','end_date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = Produk::orderBy('nama_produk','asc')->get();
        $supplier = Supplier::all();
        return view('transaksi_masuk.create',compact('produk','supplier'));
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
        $data['tgl_transaksi'] = date('Y-m-d',strtotime($data['tgl_transaksi']));
        $validasi = Validator::make($data,[
            'kd_produk'=>'required',
            'kd_supplier'=>'required',
            'tgl_transaksi'=>'required|date',
            'jumlah'=>'required|numeric',
            'harga'=>'required|numeric'
        ]);

        if ($validasi->fails()) {
            return redirect()->route('transaksi_masuk.create')->withErrors($validasi)->withInput();
        }

        TransaksiMasuk::create($data);

        $produk = Produk::find($data['kd_produk']);
        $resp['stok'] = $produk->stok + $data['jumlah'];
        $produk->update($resp);

        return redirect()->route('transaksi_masuk.index')->with('status','Transaksi Masuk Berhasil Ditambahkan!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TransaksiMasuk::findOrFail($id);

        $produk = Produk::find($data['kd_produk']);
        $resp['stok'] = $produk->stok - $data['jumlah'];
        $produk->update($resp);

        $data->delete($data);

        return redirect()->route('transaksi_masuk.index')->with('status','Transaksi Masuk Dihapus!');
    }
}
