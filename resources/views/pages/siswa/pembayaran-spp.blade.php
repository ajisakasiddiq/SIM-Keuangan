@extends('layouts.app')
@section('title')
Tagihan SPP
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
                            @if (session('success'))
                            <div class="alert alert-success">
                                 {{ session('success') }}
                             </div>
                        @endif
                            <div class="row">
                                <div class="mb-3">
                                    <label for="tahunajar" class="form-label">Tahun Ajaran</label>
                                    <select class="form-control" name="tahun_pelajaran" id="tahun_pelajaran">
                                        <option value="">Pilih Tahun Ajaran</option>
                                        @foreach ($tahun as $item)
                                        <option value="{{ $item->tahunawal }}/{{ $item->tahunakhir }}">{{ $item->tahunawal }}/{{ $item->tahunakhir }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="table-responsive">
                              <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>Nominal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                      <tbody>
                                        @if ($transaksi->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data untuk tahun ajaran ini.</td>
                                        </tr>
                                    @else
                                        @foreach ($transaksi as $item)
                                            <tr>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $item->total }}</td>
                                                @if($item->status == '0') 
                                                <td><a  class="btn btn-success" data-toggle="modal" data-target="#bayar{{ $item->id }}">bayar</a></td>
                                                @elseif($item->status == '1')
                                                <td><span class="badge badge-info">Tunggu Konfirmasi</span></td>
                                                @else
                                                <td>
                                                    <span class="badge badge-success m-1">Sudah Dibayar</span><br>
                                                    <a href="/cetak-spp/{{ $item->id }}" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
                                                </td>
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
                                                            <form action="{{ route('Tagihan-spp.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                                @method('PUT')    
                                                                @csrf
                                                              <input type="hidden" name="tagihan_id" value="{{ $item->tagihan_id }}" id="tagihan_id">
                                                              <input type="hidden" name="status" value="1" id="tagihan_id">
                                                              <div class="mb-3">
                                                                Informasi Pembayaran
                                                                <ul>
                                                                    @foreach ($rekening as $item)
                                                                        
                                                                    <li>({{ $item->nama_bank }}) {{ $item->atas_nama }}- {{ $item->norek }}</li>
                                                                    @endforeach
                                                                </ul>
                                                              </div>
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
                                        @endif
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil nilai tahun_pelajaran dari parameter URL jika ada
        const urlParams = new URLSearchParams(window.location.search);
        const selectedYear = urlParams.get('tahun_pelajaran');

        // Cari elemen select berdasarkan ID
        const selectElement = document.getElementById('tahun_pelajaran');

        // Setel nilai opsi yang dipilih berdasarkan nilai tahun_pelajaran dari URL
        if (selectedYear) {
            // Loop melalui opsi dalam elemen select
            for (let i = 0; i < selectElement.options.length; i++) {
                if (selectElement.options[i].value === selectedYear) {
                    // Setel opsi yang dipilih sesuai dengan nilai tahun_pelajaran dari URL
                    selectElement.options[i].selected = true;
                    break;
                }
            }
        }

        // Tambahkan event listener untuk mengubah tahun pelajaran
        selectElement.addEventListener('change', function() {
            const selectedYear = this.value;

            // Redirect ke controller action dengan tahun_pelajaran sebagai parameter
            window.location.href = "{{ route('Tagihan-spp.index') }}" + "?tahun_pelajaran=" + selectedYear;
        });
    });
</script>



@endpush