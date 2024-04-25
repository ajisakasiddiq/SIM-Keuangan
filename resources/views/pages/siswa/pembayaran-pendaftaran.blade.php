@extends('layouts.app')
@section('title')
    Dashboard | Tagihan SPP
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tagihan SPP</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
        <div class="dashboard-content mb-3">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                              <table class="table-hover scroll-horizontal-vertical w-100">
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                      <tbody>
                                        @foreach ($transaksi as $item)
                                            <tr>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $item->total }}</td>
                                                @if($item->status == '0') 
                                                <td><a class="btn btn-success">bayar</a></td>
                                                @elseif($item->status == '1')
                                                <td><span class="badge badge-info">Tunggu Konfirmasi</span></td>
                                                @else
                                                <td><span class="badge badge-success">Sudah Dibayar</span></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                      </tbody>
                                    </div>                              
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}
    <div class="modal fade" id="editModal" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-3" id="exampleModalLabel">Edit Transaksi
                  </h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="editTaskForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="tagihan_id" value="1" id="tagihan_id">
                    <input type="hidden" name="id" value="1" id="id">
                    <input type="hidden" name="jurusan" id="jurusan">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Nama Siswa</label>
                        <select class="form-control" name="user_id" id="user_id">
                            <option value="">Pilih Siswa</option>
                            @foreach ($siswa as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                      <label for="keterangan" class="form-label">Keterangan</label>
                      <input id="keterangan" type="text" class="form-control @error('name') is-invalid @enderror" name="keterangan" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Awal Pembayaran</label>
                        <input type="date" name="date_awal" class="form-control" id="date_awal"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Batas Pembayaran</label>
                        <input type="date" name="date_akhir" class="form-control" id="date_akhir"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Metode Pembayaran</label>
                        <select class="form-control" name="metode" id="metode">
                            <option value="cash">Tunai</option>
                            <option value="cicil">Angsuran</option>
                        </select>
                    </div>     
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Total</label>
                        <input type="text" name="total" class="form-control" id="total"
                            aria-describedby="emailHelp">
                        <input type="hidden" name="jenis_transaksi" class="form-control" id="jenis_transaksi"
                            aria-describedby="emailHelp">
                    </div>
                         <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">Pilih Status</option>
                            <option value="o">Menunggu Pembayaran</option>
                            <option value="1">Pending</option>
                            <option value="2">Sudah Bayar</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
              </div>
          </div>
      </div>
  </div>
    {{-- modal add --}}
    <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title bold fs-3" id="exampleModalLabel">{{ __('Tambah Tagihan') }}</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Tagihan-spp.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="tagihan_id" value="1">
                    @if(Auth::user()->role == 'bendahara-excellent')
                    <input type="hidden" name="jurusan" value="excellent">
                    @else
                    <input type="hidden" name="jurusan" value="reguler">
                    @endif
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Nama Siswa</label>
                        <select class="form-control" name="user_id" id="user_id">
                            <option value="">Pilih Siswa</option>
                            @foreach ($siswa as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                      <label for="keterangan" class="form-label">Keterangan</label>
                      <input id="keterangan" type="text" class="form-control @error('name') is-invalid @enderror" name="keterangan" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Awal Pembayaran</label>
                        <input type="date" name="date_awal" class="form-control" id="date_awal"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Batas Pembayaran</label>
                        <input type="date" name="date_akhir" class="form-control" id="date_akhir"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Metode Pembayaran</label>
                        <select class="form-control" name="metode" id="metode">
                            <option value="cash">Tunai</option>
                            <option value="cicil">Angsuran</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Total</label>
                        <input type="text" name="total" class="form-control" id="total"
                            aria-describedby="emailHelp">
                        <input type="hidden" name="status" class="form-control" id="status"
                            aria-describedby="emailHelp" value="0">
                        <input type="hidden" name="jenis_transaksi" class="form-control" id="jenis_transaksi"
                            aria-describedby="emailHelp" value="Pendapatan">
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
            </div>
          </div>
        </div>
      </div>
{{-- end modal add --}}

</div>
@endsection
@push('addon-script')
@endpush