@extends('layouts.template')
@section('title')
Dashboard
@endsection
@section('content')
<link rel="stylesheet" media="screen, print" href="{{ asset('theme/chartjs/Chart.min.css') }}">
<script src="{{ asset('theme/chartjs/Chart.min.js') }}"></script>
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
                            <div class="col-sm-6 col-xl-3">
                                <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            {{$agen}}
                                            <small class="m-0 l-h-n">Agen</small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-user position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            @rupiah($penjualan)
                                            <small class="m-0 l-h-n">Pendapatan</small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-gem position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="p-3 bg-danger-200 rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            {{$produk}}
                                            <small class="m-0 l-h-n">Produk</small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-inventory position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="p-3 bg-info-200 rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            {{$transaksi}}
                                            <small class="m-0 l-h-n">Penjualan</small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-shopping-cart position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 6rem;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            <i class="fal fa-chart-bar"></i> <span class="fw-300">Grafik Penjualan</span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content bg-subtlelight-fade">
                                            {{-- <div id="js-checkbox-toggles" class="d-flex mb-3">
                                                <div class="custom-control custom-switch mr-2">
                                                    <input type="checkbox" class="custom-control-input" name="gra-0" id="gra-0" checked="checked">
                                                    <label class="custom-control-label" for="gra-0">Target Profit</label>
                                                </div>
                                                <div class="custom-control custom-switch mr-2">
                                                    <input type="checkbox" class="custom-control-input" name="gra-1" id="gra-1" checked="checked">
                                                    <label class="custom-control-label" for="gra-1">Actual Profit</label>
                                                </div>
                                                <div class="custom-control custom-switch mr-2">
                                                    <input type="checkbox" class="custom-control-input" name="gra-2" id="gra-2" checked="checked">
                                                    <label class="custom-control-label" for="gra-2">User Signups</label>
                                                </div>
                                            </div>--}}
                                            <canvas id="myChart"></canvas>
                                            {{-- <div id="myChart" class="w-100 mt-4" style="height: 300px"></div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                    <!-- END Page Content -->
                    <script>
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                        labels: <?=json_encode($nama_produk); ?>,
                        datasets: [{
                            label: 'Grafik Penjualan',
                            data: <?=json_encode($jumlah_penjualan);?>,

                            backgroundColor: 'rgba(29, 201, 183, 0.7)',
                            borderColor: 'rgba(29,201,183,1.2)',
                            borderWidth: 1
                        }]
                        },
                        options: {
                        scales: {
                            yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                            }]
                        }
                        }
                    });
                    </script>
@endsection
