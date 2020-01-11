<!-- BEGIN Left Aside -->
                <aside class="page-sidebar">
                    <div class="page-logo">
                        <a href="javascript:;" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                            <img src="{{ asset('theme/img/logo.png') }}" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            <span class="page-logo-text mr-1">Penjualan App</span>
                            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                        </a>
                    </div>
                    <!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav" class="primary-nav" role="navigation">
                        <div class="nav-filter">
                            <div class="position-relative">
                                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                    <i class="fal fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="info-card">
                            <img src="{{ asset('theme/img/demo/avatars/avatar-admin.png') }}" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
                            <div class="info-card-text">
                                <a href="#" class="d-flex align-items-center text-white">
                                    <span class="text-truncate text-truncate-sm d-inline-block">
                                        {{ Auth::user()->name }}
                                    </span>
                                </a>
                                <span class="d-inline-block text-truncate text-truncate-sm">{{ Auth::user()->level }}</span>
                            </div>
                            <img src="{{ asset('theme/img/card-backgrounds/cover-2-lg.png') }}" class="cover" alt="cover">
                            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                                <i class="fal fa-angle-down"></i>
                            </a>
                        </div>
                        <ul id="js-nav-menu" class="nav-menu mb-0">
                            <li class="{{ (request()->is('home*')) ? 'active' : '' }}">
                                <a href="home" title="Dashboard" data-filter-tags="dashboard">
                                    <i class="fal fa-tachometer"></i>
                                    <span class="nav-link-text" data-i18n="nav.dashboard">Dashboard</span>
                                </a>
                            </li>
                            <li class="{{ (request()->is('transaksi_masuk*')) ? 'active' : '' }}">
                                <a href="{{route('transaksi_masuk.index')}}" title="Transaksi Masuk" data-filter-tags="transaksi masuk">
                                    <i class="fal fa-shopping-bag"></i>
                                    <span class="nav-link-text" data-i18n="nav.transaksi_masuk">Transaksi Masuk</span>
                                </a>
                            </li>
                            <li class="{{ (request()->is('transaksi_masuk*') | request()->is('home*') | request()->is('laporan*')) ? '' : 'active' }}">
                                <a href="#" title="Master" data-filter-tags="master">
                                    <i class="fal fa-database"></i>
                                    <span class="nav-link-text" data-i18n="nav.master">Master</span>
                                </a>
                                <ul>
                                    @if(Auth::user()->level == 'admin')
                                    <li class="{{ (request()->is('user*')) ? 'active' : '' }}">
                                        <a href="{{ route('user.index') }}" title="User" data-filter-tags="master user">
                                            <i class="fal fa-users"></i>
                                            <span class="nav-link-text" data-i18n="nav.master_user">User</span>
                                        </a>
                                    </li>
                                    @endif
                                    <li class="{{ (request()->is('supplier*')) ? 'active' : '' }}">
                                        <a href="{{ route('supplier.index') }}" title="Supplier" data-filter-tags="master supplier">
                                            <i class="fal fa-industry"></i>
                                            <span class="nav-link-text" data-i18n="nav.master_supplier">Supplier</span>
                                        </a>
                                    </li>
                                    <li class="{{ (request()->is('pegawai*')) ? 'active' : '' }}">
                                        <a href="{{ route('pegawai.index') }}" title="Pegawai" data-filter-tags="master pegawai">
                                            <i class="fal fa-user"></i>
                                            <span class="nav-link-text" data-i18n="nav.pegawai">Pegawai</span>
                                        </a>
                                    </li>
                                    <li class="{{ (request()->is('kategori*')) ? 'active' : '' }}">
                                        <a href="{{ route('kategori.index') }}" title="Kategori" data-filter-tags="master kategori">
                                            <i class="fal fa-list-alt"></i>
                                            <span class="nav-link-text" data-i18n="nav.kategori">Kategori</span>
                                        </a>
                                    </li>
                                    <li class="{{ (request()->is('produk*')) ? 'active' : '' }}">
                                        <a href="{{ route('produk.index') }}" title="Produk" data-filter-tags="master produk">
                                            <i class="fal fa-inventory"></i>
                                            <span class="nav-link-text" data-i18n="nav.produk">Produk</span>
                                        </a>
                                    </li>
                                    <li class="{{ (request()->is('agen*')) ? 'active' : '' }}">
                                        <a href="{{ route('agen.index') }}" title="Agen" data-filter-tags="master agen">
                                            <i class="fal fa-shopping-basket"></i>
                                            <span class="nav-link-text" data-i18n="nav.agen">Agen</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ (request()->is('laporan*')) ? 'active' : '' }}">
                                <a href="{{route('laporan.index')}}" title="Laporan Penjualan" data-filter-tags="Laporan Penjualan">
                                    <i class="fal fa-file"></i>
                                    <span class="nav-link-text" data-i18n="nav.laporan_penjualan">Laporan Penjualan</span>
                                </a>
                            </li>
                            {{-- <li class="nav-title"></li> --}}
                        </ul>
                        <div class="filter-message js-filter-message bg-success-600"></div>
                    </nav>
                    <!-- END PRIMARY NAVIGATION -->
                </aside>
                <!-- END Left Aside -->
