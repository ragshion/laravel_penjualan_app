<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Penjualan Produk</title>
</head>
<body>
    <h3>Laporan Penjualan Produk</h3>
    <hr>
    <table style="width:100%" border="1">
        <thead>
            <tr>
                <td>No</td>
                <td>Nama Produk</td>
                <td>Jumlah</td>
                <td>Harga</td>
                <td>Tanggal Penjualan</td>
                <td>Nama Toko</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $row)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$row->produk->nama_produk}}</td>
                <td>{{$row->jumlah}}</td>
                <td>@rupiah($row->harga)</td>
                <td>{{$row->transaksi->tgl_penjualan}}</td>
                <td>{{$row->transaksi->agen->nama_toko}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
