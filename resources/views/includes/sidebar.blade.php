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
    @if(Auth::user()->role == 'admin')
    <div class="sidebar-heading">
        Data Master
    </div>
    <li class="nav-item">
      <a class="nav-link {{ (request()->is('data-guru')) ? 'active' : ''}}" href="{{ route('data-guru.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
             
            <span>Data Guru</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ (request()->is('data-siswa')) ? 'active' : ''}}" href="{{ route('data-siswa.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Data Siswa</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ (request()->is('data-jenis-tagihan')) ? 'active' : ''}}" href="{{ route('data-jenis-tagihan.index') }}">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Data Jenis Tagihan</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Keuangan
    </div>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Data Tagihan
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Pembayaran SPP</a>
          <a class="dropdown-item" href="#">Pembayaran Buku</a>
        </div>
      </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Pendapatan
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Product 1</a>
          <a class="dropdown-item" href="#">Product 2</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Pengeluaran
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Product 1</a>
          <a class="dropdown-item" href="#">Product 2</a>
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
        <a class="nav-link {{ (request()->is('transaksi')) ? 'active' : ''}}" href="">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Laporan Dana BOS</span></a>
    <li class="nav-item">
        <a class="nav-link {{ (request()->is('transaksi')) ? 'active' : ''}}" href="">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Laporan Dana BOS</span></a>
    <li class="nav-item">
        <a class="nav-link {{ (request()->is('transaksi')) ? 'active' : ''}}" href="">
            <i class="fa-duotone fa-user" style="--fa-primary-color: #0b64fe; --fa-secondary-color: #0b64fe;"></i>
            <span>Laporan Dana BOS</span></a>
    </li>

    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>