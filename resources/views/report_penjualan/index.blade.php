@extends('layouts.template')
@section('title')
Report Penjualan
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

                                            <a target="_blank" class="btn btn-danger waves-effect" href="{{route('report_pdf')}}"><i class="fal fa-file-pdf"></i> Cetak Pdf</a>
                                            <a target="_blank" class="btn btn-success waves-effect" href="{{route('report_excel')}}"><i class="fal fa-file-excel"></i> Export Excel</a>
                                            @if(Request::get('start_date')  && Request::get('end_date'))
                                                <div class="panel-tag">
                                                    Hasil Pencarian Report Penjualan Dari Tanggal : <code>{{ $start_date }}</code> s/d <code>{{$end_date}}</code>
                                                </div>
                                                <a class="btn btn-success waves-effect" href="{{route('laporan.index')}}"><i class="fal fa-backward"></i> Kembali</a>
                                            @endif
                                            <form method="get" action="{{route('laporan.index')}}" autocomplete="off">
                                                <div class="form-group mt-2">
                                                <label class="form-label" for="keyword">Cari Berdasarkan Tanggal</label>
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fal fa-calendar-alt"></i></span>
                                                            </div>
                                                            <input type="text" name="start_date" id="start_date" class="form-control date-picker" placeholder="Mulai Dari Tanggal"readonly>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fal fa-calendar-check"></i></span>
                                                            </div>
                                                            <input type="text" name="end_date" id="end_date" class="form-control date-picker" placeholder="Sampai Dengan Tanggal" readonly>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2"><button type="submit" class="btn btn-block btn-info"><span class="fal fa-search"></span></button></div>
                                                </div>
                                                </div>
                                            </form>
                                            <hr>
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th>Nama Produk</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                        <th>Tanggal</th>
                                                        <th>Agen</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($penjualan as $row)
                                                    <tr>
                                                        <td>{{ $loop->iteration + ($penjualan->perpage() * ($penjualan->currentPage() -1)) }}</td>
                                                        <td>{{ $row->produk->nama_produk }}</td>
                                                        <td>{{ $row->jumlah }}</td>
                                                        <td>@rupiah($row->harga)</td>
                                                        <td>{{ $row->transaksi->tgl_penjualan }}</td>
                                                        <td>{{ $row->transaksi->agen->nama_toko }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            {{ $penjualan->appends(Request::all())->links() }}
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
