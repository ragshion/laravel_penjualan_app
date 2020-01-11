@extends('layouts.template')
@section('title')
Ubah Data Pegawai
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
                                            <form method="post" action="{{route('pegawai.update',[$pegawai->username])}}" autocomplete="off">
                                            {{ method_field('put') }}
                                            @csrf
                                                <div class="form-group">
                                                    <label class="form-label" for="nama_pegawai">Nama Pegawai</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fal fa-address-card"></i></span>
                                                        </div>
                                                        <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" placeholder="Nama Pegawai" value="{{ $pegawai->nama_pegawai }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="username">Username</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fal fa-user"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Username" value="{{ $pegawai->username }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="jk">Jenis Kelamin</label>
                                                    <select class="form-control select2" id="jk" name="jk">
                                                        <option value="pria" @if($pegawai->jk == 'pria') selected @endif>Pria</option>
                                                        <option value="wanita" @if($pegawai->jk == 'wanita') selected @endif>Wanita</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="alamat">Alamat</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fal fa-address-book"></i></span>
                                                        </div>
                                                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" value="{{ $pegawai->alamat }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="is_aktif">Status</label>
                                                    <select class="form-control select2" id="is_aktif" name="is_aktif">
                                                        <option value="1" @if($pegawai->is_aktif == '1') selected @endif>Aktif</option>
                                                        <option value="2" @if($pegawai->is_aktif == '2') selected @endif>Tidak Aktif</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="password">Password</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">*</span>
                                                        </div>
                                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="password">
                                                    </div>
                                                </div>
                                                <a href="{{route('pegawai.index')}}" class="btn btn-success"><i class="fal fa-backward"></i> Kembali</a>
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
