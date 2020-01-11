@extends('layouts.template')
@section('title')
Data Kategori
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
                                            @include('alert.success')

                                            @if(Request::get('keyword'))
                                                <div class="panel-tag">
                                                    Hasil Pencarian Kategori dengan Keyword : <code>{{ Request::get('keyword') }}</code>
                                                </div>
                                                <a class="btn btn-success waves-effect" href="{{route('kategori.index')}}"><i class="fal fa-backward"></i> Kembali</a>
                                            @else
                                                <a class="btn btn-primary waves-effect" href="{{route('kategori.create')}}"><i class="fal fa-plus-circle"></i> Tambah Data</a>
                                            @endif
                                            <form method="get" action="{{route('kategori.index')}}" autocomplete="off">
                                                <div class="form-group">
                                                <label class="form-label" for="keyword">Cari Berdasarkan Kategori</label>
                                                <div class="row">
                                                    <div class="col-11">
                                                        <div class="form-group">
                                                        <input type="text" id="keyword" name="keyword" class="form-control" value="{{Request::get('keyword')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-1"><button type="submit" class="btn btn-info"><span class="fal fa-search"></span></button></div>
                                                </div>
                                                </div>
                                            </form>
                                            <hr>
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th>Nama Kategori</th>
                                                        <th>Gambar Kategori</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($kategori as $row)
                                                    <tr>
                                                        <td>{{ $loop->iteration + ($kategori->perpage() * ($kategori->currentPage() -1)) }}</td>
                                                        <td>{{ $row->kategori }}</td>
                                                        <td><img class="img-thumbnail" src="{{asset('uploads/'.$row->gambar_kategori)}}" alt="{{$row->gambar_kategori}}" width="100px"></td>
                                                        <td>
                                                            <form method="post" action="{{route('kategori.destroy',[$row->kd_kategori])}}" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                                                            @csrf
                                                            {{method_field('delete')}}
                                                            <a href="{{ route('kategori.edit',[$row->kd_kategori]) }}" class="btn btn-icon btn-warning btn-pills waves-effect waves-themed"><i class="fal fa-edit"></i></a>
                                                            <button type="submit" class="btn btn-icon btn-danger btn-pills waves-effect waves-themed"><i class="fal fa-trash-alt"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            {{ $kategori->appends(Request::all())->links() }}
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
