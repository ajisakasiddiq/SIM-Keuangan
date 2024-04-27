@extends('layouts.app')
@section('title')
    Detail Pembayaran
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pembayaran</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
        <div class="dashboard-content mb-3">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="row ml-2 mt-2">
                            <div class="col-md-6">
                                <p>Detail Biaya</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row ml-2 mt-2">
                            <div class="col-md-2">
                                <p>Nama Siswa</p>
                                <p>NISN</p>
                                <p>Kelas</p>
                                <p>Tahun Ajaran</p>
                                <p>Status Pembayaran</p>
                            </div>
                            <div class="col-md-2">
                                <p>: Nama Siswa</p>
                                <p>: NISN</p>
                                <p>: Kelas</p>
                                <p>: Tahun Ajaran</p>
                                <p>: Status Pembayaran</p>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive m-5">
                            <table class="table-hover scroll-horizontal-vertical w-100">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Name</th>
                                          <th>Nominal</th>
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
            <br>
        {{-- </div> --}}
        <div class="dashboard-content mb-3">
           
            <div class="card">
                <div class="row ml-2 mt-2">
                    <div class="col-md-6">
                        <p>Riwayat Pembayaran/Cicilan</p>
                    </div>
                </div>
                <hr>
            <div class="row m-5">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Total Yang di Bayarkan</p>
                            <p>Kurang</p>
                        </div>
                        <div class="col-md-6">
                            <p>Total Yang di Bayarkan</p>
                            <p>Kurang</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                        <div class="table-responsive m-2">
                            <table class="table-hover scroll-horizontal-vertical w-100">
                                  <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Nominal</th>
                                        <th>Aksi</th>
                                      </tr>
                                  </thead>
                                    <tbody>
                                        <tr>
                                            <td>r</td>
                                            <td>r</td>
                                            <td>r</td>
                                            <td>r</td>
                                        </tr>
                                    </tbody>
                                  </div>                              
                           
                              </table>
                        </div>
                    </div>
                </div>
            </div>
</div>
@endsection
@push('addon-script')

@endpush