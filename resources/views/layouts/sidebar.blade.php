<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Verte Telor</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('stok.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Stok telur
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" dusk="sidebar-transaksi-treeview">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Transaksi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('transaksi.masuk.index') }}" class="nav-link"
                                dusk="sidebar-transaksi-masuk-index">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transaksi.keluar.index') }}" class="nav-link"
                                dusk="sidebar-transaksi-masuk-index">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Keluar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transaksi.retur.index') }}" class="nav-link"
                                dusk="sidebar-transaksi-retur-index">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Retur</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    @if (Auth::user()->role == 'admin')
                        <a href="#" class="nav-link" dusk="sidebar-master-treeview">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Master Data
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('master-data.satuan-besar.index') }}" class="nav-link"
                                    dusk="sidebar-master-satuan-besar-index">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Satuan Besar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('master-data.satuan-kecil.index') }}" class="nav-link"
                                    dusk="sidebar-master-satuan-kecil-index">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Satuan Kecil</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('master-data.suplier.index') }}" class="nav-link"
                                    dusk="sidebar-master-suplier-index">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Suplier</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('master-data.telur.index') }}" class="nav-link"
                                    dusk="sidebar-master-telur-index">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Telur</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('master-data.user.index') }}" class="nav-link"
                                    dusk="sidebar-master-user-index">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User</p>
                                </a>
                            </li>
                        </ul>
                    @endif
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
