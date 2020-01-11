<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Agen;
use App\Transaksi;
use App\TransaksiDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // menghasilkan jumlah pada tabel produk dan agen
        $produk = Produk::count();
        $agen = Agen::count();
        // menjumlahkan nilai pada kolom jumlah di tabel transaksi detail
        $transaksi = TransaksiDetail::sum('jumlah');
        $penjualan = Transaksi::sum('total');

        $nama_produk = [];
        $jumlah_penjualan = [];

        $data_produk = Produk::all();
        foreach ($data_produk as $row) {
            $nama_produk[] = $row->nama_produk;
            $jumlah_transaksi = TransaksiDetail::where('kd_produk',$row->kd_produk)->sum('jumlah');
            $jumlah_penjualan[] = $jumlah_transaksi;
        }

        return view('home',compact('produk','agen','transaksi','penjualan','nama_produk','jumlah_penjualan'));
    }
}
