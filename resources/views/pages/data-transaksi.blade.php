@extends('layouts.app')
@section('title')
    Dashboard | Laporan Keuangan
@endsection
@php
    use Carbon\Carbon;
    Carbon::setLocale('id'); // Set locale ke Bahasa Indonesia ('id')
@endphp


@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Keuangan</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
        <div class="dashboard-content mb-3">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <select id="filter-month" name="bulan" id="bulan" class="form-control">
                                        <option value="">Pilih Bulan</option>
                                        @foreach($listbulan as $key => $nama_bulan)
                                            <option value="{{ $key }}">{{ $nama_bulan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" name="tahun" id="tahun">
                                        <option value="">Pilih Tahun</option>
                                        @php
                                            $startYear = 2010; // Tahun mulai
                                            $currentYear = date('Y'); // Tahun sekarang
                                                                
                                            // Perulangan untuk menghasilkan opsi tahun dari tahun mulai hingga tahun sekarang
                                            for ($year = $currentYear; $year >= $startYear; $year--) {
                                                // Buat opsi tahun
                                                echo '<option value="' . $year . '">' . $year . '</option>';
                                            }
                                        @endphp
                                    </select>                
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" onclick="handleSubmit()">View</button>
                                    <button type="button" onclick="print()" class="btn btn-success">
                                        Print
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br><br><br>
            {{-- laporan keuangan --}}
        <div class="dashboard-content mb-3">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    {{-- <a href="{{ route('export.data', ['bulan' => $bulan, 'tahun' => $tahun]) }}" class="btn btn-primary">Export Data</a> --}}
                                    {{-- <div class="d-sm-flex align-items-center justify-content-between">
                                        <span class="mb-0 text-gray-800">Laporan Keuangan</span>
                                    </div> --}}
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive">
                              <table class="table-bordered text-center scroll-horizontal-vertical w-100">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Name</th>
                                            <th colspan="2">Total</th> 
                                        </tr>
                                        <tr>
                                           
                                            <th class="bg-success text-light">Pemasukan</th> <!-- Warna hijau untuk Pemasukan -->
                                            <th class="bg-danger text-light">Pengeluaran</th> 
                                        </tr>
                                    </thead>
                                      <tbody>
                                          @foreach($transactions as $data)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $data->nama_tagihan }}</td>
                                            @if($data->jenis_transaksi == 'Pendapatan')
                                            <td >Rp. {{ number_format($data->jumlah, 0, ',', '.') }}</td>
                                            <td >-</td> 
                                             <!-- Warna hijau untuk Pemasukan -->
                                             @elseif($data->jenis_transaksi == 'Pengeluaran')
                                             <td >-</td>
                                            <td >Rp. {{ number_format($data->jumlah, 0, ',', '.') }}</td> 
                                            @endif
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">Total</td>
                                            <td colspan="2">Rp. </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Jumlah Saldo {{ Carbon::createFromFormat('m', $bulan)->translatedFormat('F') }}
                                                {{ $tahun }}</td>
                                            <td colspan="2">Rp. {{ number_format($totalsaldo, 0, ',', '.') }}</td>
                                        </tr>
                                      </tbody>
                                      
                                    </table>
                                </div>                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
</div>
@endsection
@push('addon-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dapatkan nilai bulan dan tahun dari parameter URL (jika ada)
        var urlParams = new URLSearchParams(window.location.search);
        var selectedMonth = urlParams.get('bulan');
        var selectedYear = urlParams.get('tahun');

        // Setel nilai terpilih pada elemen <select> bulan dan tahun (jika nilai tersedia)
        var selectMonth = document.getElementById('filter-month');
        var selectYear = document.getElementById('tahun');

        if (selectedMonth) {
            selectMonth.value = selectedMonth;
        }

        if (selectedYear) {
            selectYear.value = selectedYear;
        }
    });

    function handleSubmit() {
        // Dapatkan nilai yang dipilih dari elemen <select> bulan dan tahun
        var selectedMonth = document.getElementById('filter-month').value;
        var selectedYear = document.getElementById('tahun').value;

        // Kirim nilai yang dipilih ke URL yang sesuai (misalnya, ke endpoint dengan AJAX atau sebagai parameter URL)
        if (selectedMonth && selectedYear) {
            window.location.href = "{{ route('Laporan-Keuangan.index') }}?bulan=" + selectedMonth + "&tahun=" + selectedYear;
        } else {
            // Tampilkan pesan atau ambil tindakan lain jika nilai bulan atau tahun tidak dipilih
            alert('Harap pilih bulan dan tahun sebelum mengirim.');
        }
    }
    function print() {
        // Dapatkan nilai yang dipilih dari elemen <select> bulan dan tahun
        var selectedMonth = document.getElementById('filter-month').value;
        var selectedYear = document.getElementById('tahun').value;

        // Kirim nilai yang dipilih ke URL yang sesuai (misalnya, ke endpoint dengan AJAX atau sebagai parameter URL)
        if (selectedMonth && selectedYear) {
            // Contoh: Redirect ke URL dengan parameter bulan dan tahun
            window.location.href = "{{ route('export.data') }}?bulan=" + selectedMonth + "&tahun=" + selectedYear;
        } else {
            // Tampilkan pesan atau ambil tindakan lain jika nilai bulan atau tahun tidak dipilih
            alert('Harap pilih bulan dan tahun sebelum mengirim.');
        }
    }
</script>

@endpush