@extends('layouts.app')
@section('title')
    Dashboard | Data Siswa
@endsection

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
                                    <label for="filter">Type Transaksi :</label>
                                    <select id="filter-year" class="form-control">
                                      <option value="">Pilih type</option>
                                        <option value="option1">Pendapatan</option>
                                        <option value="option2">Pengeluaran</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive">
                              <table class="table-hover scroll-horizontal-vertical w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>keterangan</th>
                                            <th>date_awal</th>
                                            <th>date_akhir</th>
                                            <th>Total</th>
                                            <th>jenis_transaksi</th>
                                            <th>bukti_transaksi</th>
                                            <th>metode</th>
                                            <th>status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                      <tbody>
                                      </tbody>
                                    </div>                              
                             
                                </table>
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
                                    <a href="" class="btn btn-primary mb-3" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adduser">
                                        Print
                                    </a>
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive">
                              <table class="table-hover scroll-horizontal-vertical w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>keterangan</th>
                                            <th>date_awal</th>
                                            <th>date_akhir</th>
                                            <th>Total</th>
                                            <th>jenis_transaksi</th>
                                            <th>bukti_transaksi</th>
                                            <th>metode</th>
                                            <th>status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                      <tbody>
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

@endpush