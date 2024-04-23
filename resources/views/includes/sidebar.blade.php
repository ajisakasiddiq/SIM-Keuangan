<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">SIM-Keuangan</div> 
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('/')) ? 'active' : ''}}">
        <a class="nav-link {{ (request()->is('dashboard')) ? 'active' : ''}}" href="{{ route('dashboard') }}"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading --> 
    @if(Auth::user()->role == 'admin-tu')
    <div class="sidebar-heading">
        Data Master
    </div>
    <li class="nav-item">
      <a class="nav-link {{ (request()->is('data-guru')) ? 'active' : ''}}" href="{{ route('data-guru.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
             
            <span>Data Guru</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ (request()->is('data-jenis-tagihan')) ? 'active' : ''}}" href="{{ route('data-jenis-tagihan.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Data Jenis Tagihan</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    @elseif(Auth::user()->role == 'admin-keuangan')
    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>
    <li class="nav-item">
      <a class="nav-link {{ (request()->is('data-siswa')) ? 'active' : ''}}" href="{{ route('data-siswa.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Data Siswa</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ (request()->is('data-siswa')) ? 'active' : ''}}" href="{{ route('data-jenis-tagihan.index') }}">
            <i class="fa-money-check-alt" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Kategori Tagihan Siswa</span></a>
    </li>
    <div class="sidebar-heading">
        Data Keuangan
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pembayaran"
          aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Data Pembayaran Siswa</span>
      </a>
      <div id="pembayaran" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Data Pembayaran Siswa</h6>
              <a class="collapse-item"  href="{{ route('data-tagihan-Pendaftaran.index') }}">Pendaftaran Kelas 7</a>
              <a class="collapse-item"  href="{{ route('data-tagihan-kainSeragam.index') }}">Kain Seragam</a> 
              <a class="collapse-item"  href="{{ route('data-tagihan-spp.index') }}">SPP</a>
              <a class="collapse-item"  href="{{ route('data-tagihan-DaftarUlang.index') }}">Daftar Ulang</a>
              <a class="collapse-item"  href="{{ route('data-tagihan-lainnya.index') }}">Pembayaran Lain-Lainnya</a
          </div>
      </div>
  </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi"
          aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Data Transaksi</span>
      </a>
      <div id="transaksi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Data Pembayaran Siswa</h6>
              <a class="collapse-item" href="{{ route('data-pendapatan.index') }}">Pendapatan</a>
              <a class="collapse-item" href="buttons.html">Pengeluaran</a>
          </div>
      </div>
  </li>

         <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        
    </div>
    <div class="sidebar-heading">
        Laporan Keuangan
    </div>
    <li class="nav-item">
      <a class="nav-link {{ (request()->is('data-siswa')) ? 'active' : ''}}" href="{{ route('data-siswa.index') }}">
            <i class="fa-money-check-alt" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Laporan</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    @elseif(Auth::user()->role == 'siswa')
    <li class="nav-item">
      <a class="nav-link {{ (request()->is('data-guru')) ? 'active' : ''}}" href="{{ route('data-guru.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
             
            <span>Tagihan</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ (request()->is('data-siswa')) ? 'active' : ''}}" href="{{ route('data-siswa.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Riwayat Pembayaran</span></a>
    </li>
    @endif
    <!-- Divider -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>