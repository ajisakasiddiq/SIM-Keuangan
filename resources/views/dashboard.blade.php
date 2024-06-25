@extends('layouts.app')

@section('title')
    Dashboard | Sistem Informasi Manajemen Keuangan
@endsection
@push('addon-style')
    <style>
        .custom-card-body {
    height: 400px; /* Atur tinggi sesuai kebutuhan */
    padding: 20px; /* Atur padding untuk memberikan ruang tambahan di dalam card body */
    overflow-y: auto; /* Aktifkan overflow jika konten melebihi tinggi yang ditetapkan */
}

    </style>
@endpush
@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">


            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>
@if(Auth::user()->role == 'siswa')
<!-- Content Row -->
<div class="row justify-content-center mt-4">
    <!-- Welcome Message -->
    <div class="col-xl-12">
        <div class="card shadow mb-4">
             <!-- Logo and School Name -->
    <div class="col-xl-12 col-md-12 mb-4 mt-4 text-center">
        <img src="img/logo.png" alt="Logo MTS Zainul Hasan" style="width: 550px; height: 550px;">
        <h1 class="mt-3 font-weight-bold">MTS Zainul Hasan Balung</h1>
        <p>Jl. Alamat Sekolah No.123, Kota, Provinsi</p>
    </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">



    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Tagihan Berjalan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tagihanberjalan }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-12 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Tagihan Pending</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tagihanpending }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-12 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Tagihan Lunas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tagihanlunas }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@elseif(Auth::user()->role == 'admin')
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Jumlah Siswa Excellent</div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswaexcellent }}</div>
                {{-- <small>Pendapatan Minggu Ini (Rp. {{ number_format($pendapatan, 0, ',', '.') }})</small> --}}
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Jumlah Siswa Reguler</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswareguler }}</div>
                        {{-- <small>Pengeluaran Minggu Ini (Rp. {{ number_format($pendapatan, 0, ',', '.') }})</small> --}}
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Content Row -->

{{-- <div class="row"> --}}

    <!-- Area Chart -->
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Title -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Selamat Datang {{ Auth::user()->name }}</h6>
            </div>
            <!-- Card Body - Content -->
            <div class="card-body custom-card-body">
                <p>Ini adalah pesan selamat datang untuk {{ Auth::user()->name }}.</p>
            </div>
        </div>
    </div>
    
    
{{-- </div> --}}

@elseif(Auth::user()->role == 'admin-excellent')
<div class="row justify-content-center">
    <div class="col-xl-12 col-md-10 mb-10">
        <div class="card shadow mb-4">
            <div class="card-body text-center custom-card-body">
                <h2 class="m-5">Selamat Datang di SIM-K Mts Zainul Hasan Balung</h2>
            </div>
        </div>
    </div>
</div>
@elseif(Auth::user()->role == 'admin-reguler')
<div class="row justify-content-center m-12">
    <div class="col-xl-12 col-md-10">
        <div class="card shadow mb-4">
            <div class="card-body text-center custom-card-body">
                <h2 class="m-5">Selamat Datang di SIM-K Mts Zainul Hasan Balung</h2>
            </div>
        </div>
    </div>
</div>
@else
                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Pendapatan(Hari Ini)</div>
        
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($pendapatan, 0, ',', '.') }}</div>
                                {{-- <small>Pendapatan Minggu Ini (Rp. {{ number_format($pendapatan, 0, ',', '.') }})</small> --}}
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Pengeluaran(Hari Ini)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($pengeluaran, 0, ',', '.') }}</div>
                                        {{-- <small>Pengeluaran Minggu Ini (Rp. {{ number_format($pendapatan, 0, ',', '.') }})</small> --}}
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Saldo</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($pendapatanbulan - $pengeluaranbulan , 0, ',', '.') }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                            Pendapatan Pending</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($totalpending, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->

                <div class="row">

                    <!-- Area Chart -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan Bulanan</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Perbandingan Keuangan Bulanan</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="piechart"></canvas>
                                </div>
                                <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-primary"></i> Pendapatan
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-success"></i> Pengeluaran
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                @endif


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
</div>
@endsection
@push('addon-script')
<script>

document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('piechart').getContext('2d');

    // Data pendapatan dan pengeluaran dari database
    var pendapatanbulan = {!! json_encode($pendapatanbulan) !!};
    var pengeluaranbulan = {!! json_encode($pengeluaranbulan) !!};

    var piechart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Pendapatan', 'Pengeluaran'],
            datasets: [{
                data: [pendapatanbulan, pengeluaranbulan],
                backgroundColor: ['#007bff', '#28a745'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#333',
                    fontSize: 14
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.labels[tooltipItem.index] || '';
                        var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                        return label + ': Rp. ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            }
        }
    });
});



document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('chart').getContext('2d');

    var data = {!! json_encode($pendapatanBulanan) !!}; // Mendapatkan data pendapatan bulanan dari PHP

    // Array nama bulan
    var monthNames = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    // Mengubah label bulan dari angka menjadi nama bulan
    var labels = data.map(function(item) {
        var monthIndex = parseInt(item.bulan) - 1; // Karena index bulan dimulai dari 0
        return monthNames[monthIndex];
    });

    var values = data.map(function(item) {
        return item.total_pendapatan; // Mengambil nilai total pendapatan dari data
    });

    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Pendapatan',
                data: values,
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderColor: 'rgba(78, 115, 223, 1)',
                pointRadius: 3,
                pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointBorderColor: 'rgba(78, 115, 223, 1)',
                pointHoverRadius: 3,
                pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                pointHitRadius: 10,
                pointBorderWidth: 2,
                lineTension: 0.3
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        maxTicksLimit: 5,
                        padding: 10,
                        callback: function(value, index, values) {
                            return 'Rp. ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': Rp. ' + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            }
        }
    });
});

</script>
@endpush
