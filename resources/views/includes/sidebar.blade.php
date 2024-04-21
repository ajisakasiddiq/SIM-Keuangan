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
        <a class="nav-link {{ (request()->is('data-tagihan')) ? 'active' : ''}}" href="{{ route('data-tagihan.index') }}">
              <i class="fa-money-check-alt" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
              <span>Data Pembayaran Siswa</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (request()->is('data-transaksi')) ? 'active' : ''}}" href="{{ route('data-transaksi.index') }}">
              <i class="fa-money-check-alt" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
              <span>Data Transaksi</span></a>
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