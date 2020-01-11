@extends('layouts.template')
@section('title')
Tambah Data Kategori
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
                                            <form method="post" action="{{route('kategori.store')}}" autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                                <div class="form-group">
                                                    <label class="form-label" for="kategori">Nama Kategori</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fal fa-list"></i></span>
                                                        </div>
                                                        <input type="text" name="kategori" id="kategori" class="form-control" placeholder="Kategori" value="{{ old('kategori') }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="gambar_kategori">Gambar Kategori</label>
                                                    <input type="file" class="form-control" id="gambar_kategori" name="gambar_kategori">
                                                </div>
                                                <a href="{{route('kategori.index')}}" class="btn btn-success"><i class="fal fa-backward"></i> Kembali</a>
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
