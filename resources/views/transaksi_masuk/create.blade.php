@extends('layouts.template')
@section('title')
Tambah Data Transaksi Masuk
@endsection
@section('content')
<!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                        <div class="subheader">
                            <h1 class="subheader-title">
                                <i class='subheader-icon fal fa-'></i> @yield('title')
                            </h1>
                            <div class="subheader-block">
                                <a href="javascript:;">Penjualan</a> / @yield('title')
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Panel <span class="fw-300"><i>@yield('title')</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            @include('alert.error')
                                            <form method="post" action="{{route('transaksi_masuk.store')}}" autocomplete="off">
                                            @csrf
                                                <div class="form-group">
                                                    <label class="form-label" for="kd_produk">Produk</label>
                                                    <select class="form-control select2" id="kd_produk" name="kd_produk">
                                                        <option></option>
                                                        @foreach($produk as $row)
                                                        <option value="{{$row->kd_produk}}" @if(old('kd_produk') == $row->kd_produk) selected @endif>{{$row->nama_produk}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="kd_supplier">Nama Supplier</label>
                                                    <select class="form-control select2" id="kd_supplier" name="kd_supplier">
                                                        <option></option>
                                                        @foreach($supplier as $row)
                                                        <option value="{{$row->kd_supplier}}" @if(old('kd_supplier') == $row->kd_supplier) selected @endif>{{$row->nama_supplier}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="tgl_transaksi">Tanggal Transaksi</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fal fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="text" name="tgl_transaksi" id="tgl_transaksi" class="form-control date-picker" placeholder="Tanggal Transaksi" value="{{ old('tgl_transaksi') }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="jumlah">Jumlah</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fal fa-list"></i></span>
                                                        </div>
                                                        <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Jumlah" value="{{ old('jumlah') }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="harga">Harga</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp.</span>
                                                        </div>
                                                        <input type="number" name="harga" id="harga" class="form-control" placeholder="Harga" value="{{ old('harga') }}">
                                                    </div>
                                                </div>
                                                <a href="{{route('transaksi_masuk.index')}}" class="btn btn-danger"><i class="fal fa-backward"></i> Kembali</a>
                                                <button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                    <!-- END Page Content -->
@endsection
