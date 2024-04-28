@extends('layouts.app')
@section('title')
     Tagihan Lainnya
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tagihan Lainnya</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
        <div class="dashboard-content mb-3">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Keterangan</th>
                                            <th>Nominal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                      <tbody>
                                        @foreach ($transaksi as $item)
                                            <tr>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $item->total }}</td>
                                                @if($item->status == '0') 
                                                <td><a  class="btn btn-success" data-toggle="modal" data-target="#bayar{{ $item->id }}">bayar</a></td>
                                                @elseif($item->status == '1')
                                                <td><span class="badge badge-info">Tunggu Konfirmasi</span></td>
                                                @else
                                                <td><span class="badge badge-success">Sudah Dibayar</span></td>
                                                @endif
                                            </tr>

                                            <div class="modal fade" id="bayar{{ $item->id }}" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-3" id="exampleModalLabel">Edit Transaksi
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('Tagihan-Lainnya.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                                @method('PUT')    
                                                                @csrf
                                                              <input type="hidden" name="tagihan_id" value="{{ $item->tagihan_id }}" id="tagihan_id">
                                                              <input type="hidden" name="status" value="1" id="tagihan_id">
                                                              <div class="mb-3">
                                                                <label for="keterangan" class="form-label">Bukti Pembayaran</label>
                                                                <input type="file" name="bukti_transaksi" id="bukti_transaksi" class="form-control-file">
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
</div>
@endsection
@push('addon-script')
@endpush