@extends('layouts.template')
@section('title')
Ubah Data Supplier
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
                                            <form method="post" action="{{route('supplier.update',[$supplier->kd_supplier])}}" autocomplete="off">
                                            {{ method_field('put') }}
                                            @csrf
                                                <div class="form-group">
                                                    <label class="form-label" for="nama_supplier">Nama Supplier</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fal fa-address-card"></i></span>
                                                        </div>
                                                        <input type="text" name="nama_supplier" id="nama_supplier" class="form-control" placeholder="Nama Supplier" aria-label="nama_supplier" aria-describedby="nama_supplier" value="{{ $supplier->nama_supplier }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="alamat_supplier">Alamat Supplier</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fal fa-user"></i></span>
                                                        </div>
                                                        <input type="text" name="alamat_supplier" id="alamat_supplier" class="form-control" placeholder="Alamat Supplier" aria-label="alamat_supplier" aria-describedby="alamat_supplier" value="{{ $supplier->alamat_supplier }}">
                                                    </div>
                                                </div>
                                                <a href="{{route('supplier.index')}}" class="btn btn-success"><i class="fal fa-backward"></i> Kembali</a>
                                                <button type="submit" class="btn btn-info"><i class="fal fa-recycle"></i> Perbarui</button>
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
