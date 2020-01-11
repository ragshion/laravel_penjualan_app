@extends('layouts.template')
@section('title')
Data Agen
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
                                                    Hasil Pencarian Agen dengan Keyword : <code>{{ Request::get('keyword') }}</code>
                                                </div>
                                                <a class="btn btn-success waves-effect" href="{{route('agen.index')}}"><i class="fal fa-backward"></i> Kembali</a>
                                            @endif
                                            <form method="get" action="{{route('agen.index')}}" autocomplete="off">
                                                <div class="form-group">
                                                <label class="form-label" for="keyword">Cari Berdasarkan Nama Toko</label>
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
                                                        <th>Nama Toko</th>
                                                        <th>Nama Pemilik</th>
                                                        <th>Alamat</th>
                                                        <th>Lat</th>
                                                        <th>Lng</th>
                                                        <th>Gambar Toko</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($agen as $row)
                                                    <tr>
                                                        <td>{{ $loop->iteration + ($agen->perpage() * ($agen->currentPage() -1)) }}</td>
                                                        <td>{{ $row->nama_toko }}</td>
                                                        <td>{{ $row->nama_pemilik }}</td>
                                                        <td>{{ $row->alamat }}</td>
                                                        <td>{{ $row->latitude }}</td>
                                                        <td>{{ $row->longitude }}</td>
                                                        <td><img class="img-thumbnail" src="{{asset('uploads/'.$row->gambar_toko)}}" alt="{{$row->gambar_kategori}}" width="100px"></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            {{ $agen->appends(Request::all())->links() }}
                                            <div id="map" style="width:100%; height:400px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                    <!-- END Page Content -->
                    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{$api->map_api}}"></script>
                    <script src="{{asset('theme/js/gmaps.js')}}"></script>
                    <script>

                        var map;
                        var locations = <?= $hasil_latlng; ?>;

                        $(function(){
                            map = new GMaps({
                                div: '#map',
                                lat: {{$lokasi->latitude}},
                                lng: {{$lokasi->longitude}},
                                gestureHandling: 'greedy'
                            });

                            for (var i = 0; i < locations.length; i++) {
                                map.addMarker({
                                    lat: parseFloat(locations[i][1]),
                                    lng: parseFloat(locations[i][2]),
                                    title: locations[i][0],
                                    infoWindow: {
                                    content: '<p>'+locations[i][0]+'</p>'
                                    }
                                });
                            }
                        })
                    </script>
@endsection
