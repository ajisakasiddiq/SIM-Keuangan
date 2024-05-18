<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">SIM-Keuangan</div> 
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('/')) ? 'active' : ''}}">
        <a class="nav-link {{ (request()->is('dashboard')) ? 'active' : ''}}" href="{{ route('dashboard.index') }}"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a>
    </li>

    @if(Auth::user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link {{ (request()->is('data-user')) ? 'active' : ''}}" href="{{ route('data-user.index') }}">
              <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
              <span>Data User</span></a>
      </li>
    <li class="nav-item">
        <a class="nav-link {{ (request()->is('data-siswa')) ? 'active' : ''}}" href="{{ route('data-siswa.index') }}">
              <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
              <span>Data Siswa</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (request()->is('Tahun-Ajaran*')) ? 'active' : ''}}" href="{{ route('Tahun-Ajaran.index') }}">
              <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
              <span>Data Tahun Ajaran</span></a>
      </li>
      
    @elseif(Auth::user()->role == 'bendahara-excellent')
    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>
    <li class="nav-item">
        <a class="nav-link {{ (request()->is('data-rekening*')) ? 'active' : ''}}" href="{{ route('data-rekening.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Data Rekening</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ (request()->is('data-jenis-tagihan*')) ? 'active' : ''}}" href="{{ route('data-jenis-tagihan.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Data Keuangan</span>
        </a>
    </li>
    <div class="sidebar-heading">
        Data Keuangan
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed {{ (request()->is('data-tagihan*')) ? 'active' : ''}}" href="#" data-toggle="collapse" data-target="#pembayaran"
           aria-expanded="true" aria-controls="pembayaran">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data keuangan Siswa</span>
        </a>
        <div id="pembayaran" class="collapse {{ (request()->is('data-tagihan*')) ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data keuangan Siswa</h6>
                <a class="collapse-item {{ (request()->is('data-tagihan-Pendaftaran*')) ? 'active' : ''}}" href="{{ route('data-tagihan-Pendaftaran.index') }}">Pendaftaran Kelas 7</a>
                <a class="collapse-item {{ (request()->is('data-tagihan-kainSeragam*')) ? 'active' : ''}}" href="{{ route('data-tagihan-kainSeragam.index') }}">Kain Seragam</a>
                <a class="collapse-item {{ (request()->is('data-tagihan-spp*')) ? 'active' : ''}}" href="{{ route('data-tagihan-spp.index') }}">SPP</a>
                <a class="collapse-item {{ (request()->is('data-tagihan-DaftarUlang*')) ? 'active' : ''}}" href="{{ route('data-tagihan-DaftarUlang.index') }}">Daftar Ulang</a>
                <a class="collapse-item {{ (request()->is('data-tagihan-lainnya*')) ? 'active' : ''}}" href="{{ route('data-tagihan-lainnya.index') }}">Pembayaran Lain-Lainnya</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed {{ (request()->is('data-pendapatan*') || request()->is('data-pengeluaran*')) ? 'active' : ''}}" href="#" data-toggle="collapse" data-target="#transaksi"
           aria-expanded="true" aria-controls="transaksi">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Transaksi</span>
        </a>
        <div id="transaksi" class="collapse {{ (request()->is('data-pendapatan*') || request()->is('data-pengeluaran*')) ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Pembayaran Siswa</h6>
                <a class="collapse-item {{ (request()->is('data-pendapatan*')) ? 'active' : ''}}" href="{{ route('data-pendapatan.index') }}">Pendapatan</a>
                <a class="collapse-item {{ (request()->is('data-pengeluaran*')) ? 'active' : ''}}" href="{{ route('data-pengeluaran.index') }}">Pengeluaran</a>
            </div>
        </div>
    </li>
    
   <!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading"></div>
<div class="sidebar-heading">Laporan Keuangan</div>

<li class="nav-item">
    <a class="nav-link collapsed {{ (request()->is('data-tagihan*')) ? 'active' : ''}}" href="#" data-toggle="collapse" data-target="#rekap"
       aria-expanded="true" aria-controls="pembayaran">
        <i class="fas fa-fw fa-cog"></i>
        <span>Rekapitulasi Keuangan</span>
    </a>
    <div id="rekap" class="collapse {{ (request()->is('data-tagihan*')) ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Rekapitulasi Keuangan</h6>
            <a class="collapse-item {{ (request()->is('data-tagihan-Pendaftaran*')) ? 'active' : ''}}" href="{{ route('data-tagihan-Pendaftaran.index') }}">Pendaftaran Kelas 7 (ON PROGRESS)</a>
            <a class="collapse-item {{ (request()->is('data-tagihan-kainSeragam*')) ? 'active' : ''}}" href="{{ route('data-tagihan-kainSeragam.index') }}">Kain Seragam (ON PROGRESS)</a>
            <a class="collapse-item {{ (request()->is('data-tagihan-spp*')) ? 'active' : ''}}" href="{{ route('data-tagihan-spp.index') }}">SPP (ON PROGRESS)</a>
            <a class="collapse-item {{ (request()->is('data-tagihan-DaftarUlang*')) ? 'active' : ''}}" href="{{ route('data-tagihan-DaftarUlang.index') }}">Daftar Ulang (ON PROGRESS)</a>
            <a class="collapse-item {{ (request()->is('data-tagihan-lainnya*')) ? 'active' : ''}}" href="{{ route('data-tagihan-lainnya.index') }}">Pembayaran Lain-Lainnya (ON PROGRESS)</a>
            <a class="collapse-item {{ (request()->is('data-tagihan-lainnya*')) ? 'active' : ''}}" href="{{ route('data-tagihan-lainnya.index') }}">Rekapitulasi Pendapatan (ON PROGRESS)</a>
            <a class="collapse-item {{ (request()->is('Rekapitulasi-pengeluaran*')) ? 'active' : ''}}" href="{{ route('Rekapitulasi-pengeluaran.index') }}">Rekapitulasi Pengeluaran</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link {{ (request()->is('laporan')) ? 'active' : ''}}" href="{{ route('Laporan-Keuangan.index') }}">
        <i class="fa-money-check-alt" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
        <span>Laporan</span>
    </a>
</li>


    <hr class="sidebar-divider d-none d-md-block">


    @elseif(Auth::user()->role == 'bendahara-reguler')
    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>
    <li class="nav-item">
        <a class="nav-link {{ (request()->is('data-rekening*')) ? 'active' : ''}}" href="{{ route('data-rekening.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Data Rekening</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ (request()->is('data-jenis-tagihan*')) ? 'active' : ''}}" href="{{ route('data-jenis-tagihan.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Data Keuangan</span>
        </a>
    </li>
    <div class="sidebar-heading">
        Data Keuangan
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed {{ (request()->is('data-tagihan*')) ? 'active' : ''}}" href="#" data-toggle="collapse" data-target="#pembayaran"
           aria-expanded="true" aria-controls="pembayaran">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data keuangan Siswa</span>
        </a>
        <div id="pembayaran" class="collapse {{ (request()->is('data-tagihan*')) ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data keuangan Siswa</h6>
                <a class="collapse-item {{ (request()->is('data-tagihan-Pendaftaran*')) ? 'active' : ''}}" href="{{ route('data-tagihan-Pendaftaran.index') }}">Pendaftaran Kelas 7</a>
                <a class="collapse-item {{ (request()->is('data-tagihan-kainSeragam*')) ? 'active' : ''}}" href="{{ route('data-tagihan-kainSeragam.index') }}">Kain Seragam</a>
                <a class="collapse-item {{ (request()->is('data-tagihan-spp*')) ? 'active' : ''}}" href="{{ route('data-tagihan-spp.index') }}">SPP</a>
                <a class="collapse-item {{ (request()->is('data-tagihan-DaftarUlang*')) ? 'active' : ''}}" href="{{ route('data-tagihan-DaftarUlang.index') }}">Daftar Ulang</a>
                <a class="collapse-item {{ (request()->is('data-danabos*')) ? 'active' : ''}}" href="{{ route('data-danabos.index') }}">Dana Bos</a>
                <a class="collapse-item {{ (request()->is('data-tagihan-lainnya*')) ? 'active' : ''}}" href="{{ route('data-tagihan-lainnya.index') }}">Pembayaran Lain-Lainnya</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed {{ (request()->is('data-pendapatan*') || request()->is('data-pengeluaran*')) ? 'active' : ''}}" href="#" data-toggle="collapse" data-target="#transaksi"
           aria-expanded="true" aria-controls="transaksi">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Transaksi</span>
        </a>
        <div id="transaksi" class="collapse {{ (request()->is('data-pendapatan*') || request()->is('data-pengeluaran*')) ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Pembayaran Siswa</h6>
                <a class="collapse-item {{ (request()->is('data-pendapatan*')) ? 'active' : ''}}" href="{{ route('data-pendapatan.index') }}">Pendapatan</a>
                <a class="collapse-item {{ (request()->is('data-pengeluaran*')) ? 'active' : ''}}" href="{{ route('data-pengeluaran.index') }}">Pengeluaran</a>
            </div>
        </div>
    </li>
    
   <!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading"></div>
<div class="sidebar-heading">Laporan Keuangan</div>

<li class="nav-item">
    <a class="nav-link {{ (request()->is('rekapitulasi')) ? 'active' : ''}}" href="{{ route('Laporan-Keuangan.index') }}">
        <i class="fa-money-check-alt" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
        <span>Rekapitulasi</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ (request()->is('laporan')) ? 'active' : ''}}" href="{{ route('Laporan-Keuangan.index') }}">
        <i class="fa-money-check-alt" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
        <span>Laporan</span>
    </a>
</li>


    <hr class="sidebar-divider d-none d-md-block">

















    @elseif(Auth::user()->role == 'siswa')
    <li class="nav-item">
        <a class="nav-link {{ request()->is('Tagihan-Pendaftaran*') ? 'active' : '' }}" href="{{ route('Tagihan-Pendaftaran.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Tagihan Pendaftaran</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('Tagihan-spp*') ? 'active' : '' }}" href="{{ route('Tagihan-spp.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Tagihan SPP</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('Tagihan-DaftarUlang*') ? 'active' : '' }}" href="{{ route('Tagihan-DaftarUlang.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Tagihan Daftar Ulang</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('Tagihan-KainSeragam*') ? 'active' : '' }}" href="{{ route('Tagihan-KainSeragam.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Tagihan Kain Seragam</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('Tagihan-Lainnya*') ? 'active' : '' }}" href="{{ route('Tagihan-Lainnya.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Tagihan Lainnya</span>
        </a>
    </li>
    
    @endif















    <!-- Divider -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>