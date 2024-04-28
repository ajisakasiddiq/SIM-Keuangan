@extends('layouts.app')
@section('title')
Pembayaran Pendaftaran
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pembayaran Pendaftaran</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
        <div class="dashboard-content mb-3">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="row ml-2 mt-2">
                            <div class="col-md-6">
                                <h5>Rincian Pembayaran Pendaftaran</h5>
                            </div>
                        </div>
                        <div class="table-responsive m-5">
                            <table class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Name</th>
                                          <th>Nominal</th>
                                      </tr>
                                  </thead>
                                    <tbody>
                                        @foreach ($transaksi as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>{{ $item->total }}</td>
                                        </tr>
                                        @endforeach
                                        @foreach($total as $item)
                                        <tr>
                                            <td colspan="2" class="text-right"><strong>Total:</strong></td>
                                            <td><strong>{{ $item->total_sum }}</strong></td>
                                        </tr>
                                        @endforeach
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
                            @foreach($total as $transaksi)
                            @foreach($totalcicilan as $cicil)
                                <p>:Rp. {{ $cicil->total_sum }}</p>
                                <p>:Rp. {{ $transaksi->total_sum - $cicil->total_sum }}</p>
                        
                                @if($transaksi->total_sum - $cicil->total_sum == '0')
                            <a href="" class="btn btn-secondary" type="button" class="btn btn-primary">
                                Bayar
                            </a>
                            @else
                            <a href="" class="btn btn-success" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bayar">
                                Bayar
                            </a>
                            @endif
                            @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                   
                        <div class="table-responsive m-2">
                            <table class="table table-striped">
                                  <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Tgl Pembayaran</th>
                                        <th>Nominal</th>
                                      </tr>
                                  </thead>
                                    <tbody>
                                        @foreach ($cicilan as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->tgl }}</td>
                                            <td>{{ $item->total }}</td>
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


<div class="modal fade" id="bayar" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="exampleModalLabel">Pembayaran
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Tagihan-Pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')    
                    @csrf
                  <input type="hidden" name="tagihan_id" value="3" id="tagihan_id">
                  <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="user_id">
                  <div class="mb-3">
                    <label for="total" class="form-label">Total yg Dibayarkan</label>
                    <input  type="text" name="total" id="total" class="form-control">
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
            <button type="submit" class="btn btn-success">Selesaikan Pembayaran</button>
          </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('addon-script')

@endpush