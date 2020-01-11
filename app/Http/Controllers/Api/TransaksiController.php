<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\KeranjangResource;
use App\Http\Resources\TransaksiResource;
use App\Http\Resources\TransaksiDetailResource;
use App\Keranjang;
use App\Produk;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Transaksi;
use App\TransaksiDetail;

class TransaksiController extends Controller
{
    public function add_cart(Request $request){
        $data = $request->all();

        $validasi = Validator::make($data,[
            'username'=>'required|max:100',
            'kd_produk'=>'required|numeric',
            'jumlah'=>'required|numeric'
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status'=>FALSE,
                'message'=>$validasi->errors()
            ], 400);
        }

        // Mencari data stok produk
        $data_produk = Produk::find($data['kd_produk']);
        $stok_produk = $data_produk->stok;

        // Mencari jumlah produk, atas produk itu sendiri didalam tabel keranjng
        $jumlah_barang_cart = Keranjang::where('kd_produk',$data['kd_produk'])->sum('jumlah');

        $stok_hasil = $stok_produk - $jumlah_barang_cart;

        // jika stok hasil < dari jumlah yang diinputan maka akan menampilkan tulisan 'stok barang tidak mencukupi'
        if ($stok_hasil < $data['jumlah']) {
            return response()->json([
                'status'=>FALSE,
                'message'=>'Stok Barang tidak mencukup'
            ], 200);
        }

        $data['harga'] = $data_produk->harga;

        Keranjang::create($data);

        return response()->json([
            'status'=>TRUE,
            'message'=>'Data Berhasil Ditambahkan'
        ], 201);

    }

    public function get_cart(Request $request){
        $username = $request->input('username');
        $keranjang = Keranjang::where('username',$username)->get();

        if ($keranjang->isEmpty()) {
            return response()->json([
                'status'=>FALSE,
                'mesasge'=>'Cart Kosong'
            ], 200);
        }

        return KeranjangResource::collection($keranjang);
    }

    function delete_item_cart(Request $request){
        $kd_keranjang = $request->input('kd_keranjang');
        $keranjang = Keranjang::find($kd_keranjang);

        if (is_null($keranjang)) {
            return response()->json([
                'status'=>FALSE,
                'message'=>'Data Keranjang Tidak Ditemukan'
            ], 404);
        }

        $keranjang->delete();

        return response()->json([
            'status'=>TRUE,
            'message'=>'Data Keranjang Berhasil Dihapus!'
        ], 200);
    }

    function delete_cart(Request $request){
        $username = $request->input('username');
        Keranjang::where('username',$username)->delete();
        return response()->json([
            'status'=>FALSE,
            'message'=>'Data Keranjang Berhasil Dihapus!'
        ], 200);
    }

    function checkout(Request $request){
        $data['tgl_penjualan'] = date('Y-m-d');
        $data['kd_agen'] = $request->input('kd_agen');
        $data['username'] = $request->input('username');

        $data['no_faktur'] = $this->get_nomor_faktur();
        $data['total'] = $this->get_total_cart($data['username']);

        Transaksi::create($data);

        $cart = Keranjang::where('username',$data['username'])->get();
        foreach ($cart as $row) {
            // INSERT DARI KERANJANG KE TRANSAKSI DETAIL
            $data_cart = array(
                'no_faktur'=>$data['no_faktur'],
                'kd_produk'=>$row['kd_produk'],
                'jumlah'=>$row['jumlah'],
                'harga'=>$row['harga']
            );
            TransaksiDetail::create($data_cart);

            // UPDATE STOK DATA PRODUK
            $produk = Produk::find($row->kd_produk);
            $data_produk['stok'] = $produk->stok - $row->jumlah;
            $produk->update($data_produk);
        }

        Keranjang::where('username',$data['username'])->delete();

        return response()->json([
            'status'=>TRUE,
            'message'=>'Checkout Berhasil'
        ], 201);

    }

    private function get_nomor_faktur()
    {
        // mencari yang paling besar dengan 6 digit terakhir dengan tanggal penjualan hari ini
        $query = DB::select('SELECT MAX(RIGHT(no_faktur,6)) AS max_faktur FROM transaksi WHERE DATE(tgl_penjualan)=CURDATE()');
        $kd = "";
        if(count($query) > 0){
            foreach($query as $row)
            {
                $tmp = ((int)$row->max_faktur)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        $hasil =  date('dmy').$kd;
        return $hasil;
    }

    private function get_total_cart($username)
    {
        $data_keranjang = Keranjang::where('username',$username)->get();
        $total = 0;
        foreach($data_keranjang as $row)
        {
            $total = $total + ($row->jumlah * $row->harga);
        }
        return $total;
    }

    function get_transaksi(Request $request){
        $username = $request->input('username');
        $data_transaksi = Transaksi::where('username',$username)->get();

        if ($data_transaksi->isEmpty()) {
            return response()->json([
                'status'=>FALSE,
                'message'=>'Data Transaksi Tidak Ditemukan'
            ], 200);
        }

        return TransaksiResource::collection($data_transaksi);
    }

    function get_detail_transaksi(Request $request){
        $no_faktur = $request->input('no_faktur');
        $detail_transaksi = TransaksiDetail::where('no_faktur',$no_faktur)->get();

        if ($detail_transaksi->isEmpty()) {
            return response()->json([
                'status'=>FALSE,
                'message'=>'Detail Transaksi Tidak Ditemukan'
            ], 200);
        }

        return TransaksiDetailResource::collection($detail_transaksi);
    }


}
