@extends('layouts.app')
@section('title')
    Dashboard | Rekapitulasi Pendapatan
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rekapitulasi Pendapatan</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
        <div class="dashboard-content mb-3">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <select class="form-control" name="tagihan_id" id="tagihan_id">
                                        <option value="">Pilih Kategori</option>
                                    @foreach ($tagihan as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="bulan" id="bulan" class="form-control">
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
                            <div class="table-responsive">
                              <table class="table-hover scroll-horizontal-vertical w-100" id="tagihan">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Total</th>
                                            <th>status</th>
                                        </tr>
                                    </thead>
                                      <tbody>
                                          @foreach ($data as $item)
                                        <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->jenistagihan->name }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $item->tgl_pembayaran }}</td>
                                                <td>{{ $item->total }}</td>
                                                <td>
                                                    @switch($item->status)
                                                        @case(0)
                                                            <span class="badge badge-warning">Menunggu Pembayaran</span>
                                                            @break
                                                        @case(1)
                                                            <span class="badge badge-info">Pending</span>
                                                            @break
                                                        @case(2)
                                                            <span class="badge badge-success">Sukses</span>
                                                            @break
                                                        @default
                                                            <span class="badge badge-danger">Undefined</span>
                                                    @endswitch
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                      </tbody>
                                    </div>                              
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Total</th>
                                            <th>status</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('addon-script')


<script type="text/javascript">

  // crud
  $(document).ready(function() {
    var table=  $('#tagihan').DataTable({});
  });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dapatkan nilai bulan dan tahun dari parameter URL (jika ada)
        var urlParams = new URLSearchParams(window.location.search);
        var selectedMonth = urlParams.get('bulan');
        var selectedYear = urlParams.get('tahun');
        var selectedTagihanId = urlParams.get('tagihan_id');

        // Setel nilai terpilih pada elemen <select> bulan dan tahun (jika nilai tersedia)
        var selectMonth = document.getElementById('bulan');
        var selectYear = document.getElementById('tahun');
        var selecttagihanId = document.getElementById('tagihan_id');

        if (selectedMonth) {
            selectMonth.value = selectedMonth;
        }

        if (selectedYear) {
            selectYear.value = selectedYear;
        }
        if (selectedTagihanId) {
            selecttagihanId.value = selectedTagihanId;
        }
    });

    function handleSubmit() {
    // Dapatkan nilai yang dipilih dari elemen <select> bulan dan tahun
    var selectedMonth = document.getElementById('bulan').value;
    var selectedYear = document.getElementById('tahun').value;
    var selectedTagihanId = document.getElementById('tagihan_id').value;

    // Buat URL dengan parameter yang dipilih
    var url = "{{ route('Rekapitulasi-pendapatan.index') }}?";
    if (selectedMonth) {
        url += "bulan=" + selectedMonth + "&";
    }
    if (selectedYear) {
        url += "tahun=" + selectedYear + "&";
    }
    if (selectedTagihanId) {
        url += "tagihan_id=" + selectedTagihanId + "&";
    }

    // Hapus karakter '&' terakhir jika ada
    url = url.slice(0, -1);

    // Redirect ke URL yang dibangun
    window.location.href = url;
}

    function print() {
        // Dapatkan nilai yang dipilih dari elemen <select> bulan dan tahun
        var selectedMonth = document.getElementById('bulan').value;
        var selectedYear = document.getElementById('tahun').value;
        var selectedTagihanId = document.getElementById('tagihan_id').value;

        // Kirim nilai yang dipilih ke URL yang sesuai (misalnya, ke endpoint dengan AJAX atau sebagai parameter URL)
        if (selectedMonth && selectedYear && selectedTagihanId)  {
            // Contoh: Redirect ke URL dengan parameter bulan dan tahun
            window.location.href = "{{ route('export.data') }}?bulan=" + selectedMonth + "&tahun=" + selectedYear + "&tagihan_id" +selectedTagihanId;
        } else {
            // Tampilkan pesan atau ambil tindakan lain jika nilai bulan atau tahun tidak dipilih
            alert('Harap pilih bulan dan tahun sebelum mengirim.');
        }
    }
</script>
@endpush