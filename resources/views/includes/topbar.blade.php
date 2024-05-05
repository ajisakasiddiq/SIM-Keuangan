<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">{{ $totaltransaksi }}</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Notifikasi Pembayaran / Tagihan
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                 
                    @if($trans->isEmpty())
                    <div>
                        <span class="font-weight-bold">Tidak Ada Pembayaran Terbaru</span>
                    </div>
                    @else
                    @foreach ($trans as $item)
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-dollar-sign text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-400">{{ $item->tgl_pembayaran_formatted  }}</div>
                        @if(Auth::user()->role == 'siswa')

                        <span class="font-weight-bold">Ada tagihan {{ $item->jenistagihan->name }} baru</span>
                        @else
                        <span class="font-weight-bold">{{ $item->user->name }} Melakukan Pembayaran {{ $item->jenistagihan->name }}</span>
                        @endif
                    </div>
                    @endforeach
                    @endif
                </a>
                {{-- <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a> --}}
            </div>
        </li>
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name; }}</span>
                <img src="{{ Storage::url(Auth::user()->foto) }}"
                    class="img-account-profile rounded-circle"
                    style="max-width: 50px; max-height: 50px;">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item " href="{{ route('profile.index') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile</a>
                <a class="dropdown-item" href="{{ route('profile.index') }}" data-toggle="modal">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Setting Password
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>