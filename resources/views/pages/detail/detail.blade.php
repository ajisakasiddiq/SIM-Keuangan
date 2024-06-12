@extends('layouts.app')
@section('title')
Detail Pembayaran 
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail</h1>
    </div>

    <!-- Content Row -->
    <div class="dashboard-content mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row ml-2 mt-2">
                        <div class="col-md-6">
                            <h5>Rincian Pembayaran </h5>
                        </div>
                    </div>
                    <div class="table-responsive m-5">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Nominal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($transaksi->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada tagihan.</td>
                                </tr>
                                @else
                                @foreach ($transaksi as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ $item->total }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi</button>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item" data-toggle="modal" data-target="#editModal{{ $item->id }}">Edit</button>
                                                    <form action="{{ route('data-pendapatan.destroy', $item->id) }}" method="POST">
                                                        @csrf 
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-3" id="exampleModalLabel">Edit Transaksi</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('data-pendapatan.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="keterangan" class="form-label">Name</label>
                                                        <input id="keterangan" type="text" class="form-control @error('name') is-invalid @enderror" name="keterangan" value="{{ $item->keterangan }}" autofocus>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="total" class="form-label">Jumlah</label>
                                                        <input type="text" name="total" class="form-control" id="total" value="{{ $item->total }}">
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
                                <tr>
                                    <td colspan="2" class="text-right"><strong>Total:</strong></td>
                                    <td><strong>{{ $total->total_sum }}</strong></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="dashboard-content mb-3">
            <div class="card">
                <div class="row ml-2 mt-2">
                    <div class="col-md-6">
                        <h5>Pembayaran/Cicilan</h5>
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
                                @if($transaksi->isEmpty())
                                <p>: Rp. </p>
                                <p>: Rp. </p>
                                @else
                                @php
                                    $totalTransaksi = $total->total_sum;
                                    $totalCicilan = $totalcicilan->isNotEmpty() ? $totalcicilan->first()->total_sum : 0;
                                    $saldoSisa = $totalTransaksi - $totalCicilan;
                                @endphp
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    const totalInput = document.getElementById('total');
                                                    const submitBtn = document.getElementById('submitBtn');
                                                    const totalError = document.getElementById('totalError');
                                                    const saldoSisa = {{ $saldoSisa }};
                                                
                                                    totalInput.addEventListener('input', function() {
                                                        const totalValue = parseFloat(totalInput.value.replace(/[^0-9.-]+/g,"")) || 0;
                                                
                                                        if (totalValue > saldoSisa) {
                                                            submitBtn.disabled = true;
                                                            totalError.style.display = 'block';
                                                        } else {
                                                            submitBtn.disabled = false;
                                                            totalError.style.display = 'none';
                                                        }
                                                    });
                                                });
                                                </script>
                                <p>: Rp. {{ $totalCicilan }}</p>
                                <p>: Rp. {{ $saldoSisa }}</p>
                                @if ($saldoSisa == 0 )
                                @if($item->status == 2)
                                <h4 class="text-success">Lunas.</h4>
                                @else
                                <div>
                                    <form action="{{ route('Detailsupdate', ['user_id' => $item->user_id, 'tagihan_id' => $item->tagihan_id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="2">
                                        <button type="submit" class="btn btn-success">Selesaikan Pembayaran</button>
                                    </form>
                                </div>
                                
                                
                                @endif
                                @else
                                <a href="" class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#bayar">
                                    Bayar
                                </a>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="table-responsive m-2">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bukti Pembayaran</th>
                                        <th>Tgl Pembayaran</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($cicilan->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Anda belum melakukan pembayaran.</td>
                                    </tr>
                                    @else
                                    @foreach ($cicilan as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><a href="{{ Storage::url($item->bukti_pembayaran) }}" data-lightbox="gallery">
                                            <img src="{{ Storage::url($item->bukti_pembayaran) }}" alt="Bukti Transaksi" style="width: 100px; height: auto;">
                                        </a></td>
                                        <td>{{ $item->tgl }}</td>
                                        <td>{{ $item->total }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bayar" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="exampleModalLabel">Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Details.store') }}" method="POST" enctype="multipart/form-data">
                        @method('POST')    
                        @csrf
                        <input type="hidden" name="tagihan_id" value="{{ $tagihan_id }}" id="tagihan_id">
                        <input type="hidden" name="user_id" value="{{ $user_id }}" id="user_id">
                        <div class="mb-3">
                            <label for="total" class="form-label">Total yg Dibayarkan</label>
                            <input  type="text" name="total" id="total" class="form-control">
                            <small id="totalError" class="text-danger" style="display: none;">Pembayaran melebihi tagihan sisa.</small>
                          </div>
                          <div class="mb-3">
                            <label for="tgl" class="form-label">Tanggal Pembayaran</label>
                            <input  type="date" name="tgl" id="tgl" class="form-control">
                          </div>
                          <div class="mb-3">
                            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control-file">
                          </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="submitBtn">Selesaikan Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')

@endpush
