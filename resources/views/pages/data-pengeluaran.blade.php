@extends('layouts.app')
@section('title')
    Dashboard | Data Pengeluaran
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pengeluaran</h1>
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
                            <a href="" class="btn btn-primary mb-3" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adduser">
                                + Tambah Data
                            </a>
                            <div class="table-responsive">
                              <table class="table-hover scroll-horizontal-vertical w-100" id="tagihan">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori Keuangan</th>
                                            <th>Nota</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                      <tbody>
                                      </tbody>
                                    </div>                              
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori Keuangan</th>
                                            <th>Nota</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
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
                <form id="editTaskForm" method="POST" enctype="multipart/form-data"> 
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="id">
                    <input id="user_id" type="hidden" class="form-control" value="{{ Auth::User()->id }}" name="user_id">
                    <input id="metode" type="hidden" class="form-control" value="cash" name="metode">
                    <div class="mb-3">
                        <label for="tagihan_id">Kategori</label>
                        <select class="form-control" name="tagihan_id" id="tagihan_id">
                        @foreach ($tagihan as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="mb-3">
                      <label for="keterangan" class="form-label">Keterangan</label>
                      <input id="keterangan" type="text" class="form-control @error('name') is-invalid @enderror" name="keterangan" autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Transaksi</label>
                        <input type="date" name="tgl_pembayaran" class="form-control" id="tgl_pembayaran"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nota/kwitansi(Opsional)</label>
                        <input type="file" name="bukti_transaksi" class="form-control" id="bukti_transaksi"
                            aria-describedby="emailHelp">
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jumlah</label>
                        <input type="text" name="total" class="form-control" id="total"
                            aria-describedby="emailHelp">
                        <input type="hidden" name="status" class="form-control" id="status"
                            aria-describedby="emailHelp" value="2">
                        <input type="hidden" name="jenis_transaksi" class="form-control" id="jenis_transaksi"
                            aria-describedby="emailHelp" value="Pengeluaran">
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
              <h4 class="modal-title bold fs-3" id="exampleModalLabel">{{ __('Tambah Data') }}</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('data-pengeluaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    @if(Auth::user()->role == 'bendahara-excellent')
                    <input type="hidden" name="jurusan" id="jurusan" value="excellent">
                    @else
                    <input type="hidden" name="jurusan" id="jurusan" value="reguler">
                    @endif
                    <div class="mb-3">
                        <label for="tagihan_id">Kategori</label>
                        <select class="form-control" name="tagihan_id" id="tagihan_id">
                        @foreach ($tagihan as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="mb-3">
                      <label for="keterangan" class="form-label">Keterangan</label>
                      <input id="keterangan" type="text" class="form-control @error('name') is-invalid @enderror" name="keterangan" autofocus>
                      <input id="user_id" type="hidden" class="form-control" value="{{ Auth::User()->id }}" name="user_id">
                      <input id="metode" type="hidden" class="form-control" value="cash" name="metode">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Transaksi</label>
                        <input type="date" name="tgl_pembayaran" class="form-control" id="tgl_pembayaran"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nota/kwitansi(Opsional)</label>
                        <input type="file" name="bukti_transaksi" class="form-control" id="bukti_transaksi"
                            aria-describedby="emailHelp">
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jumlah</label>
                        <input type="text" name="total" class="form-control" id="total"
                            aria-describedby="emailHelp">
                        <input type="hidden" name="status" class="form-control" id="status"
                            aria-describedby="emailHelp" value="2">
                        <input type="hidden" name="jenis_transaksi" class="form-control" id="jenis_transaksi"
                            aria-describedby="emailHelp" value="Pengeluaran">
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
<script type="text/javascript">
  // crud
  $(document).ready(function() {
    var table=  $('#tagihan').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ url()->current() }}',
          columns: [
              {
                  data: 'no',
                  name: 'no'
              },
              {
                  data: 'jenistagihan.name',
                  name: 'Kategori Keuangan'
              },
              
              {
                  data: 'bukti_transaksi',
                  name: 'Nota'
              },
              
              { 
            data: 'keterangan',
            name: 'Keterangan',
            render: function(data, type, row) {
                // Memeriksa nilai tagihan_id untuk menentukan nilai keterangan
                if (row.tagihan_id === 6) {
                    return row.keterangan; // Mengembalikan nilai keterangan jika tagihan_id adalah 6
                } else {
                    return row.jenistagihan.name.toString(); // Mengembalikan nilai tagihan_id sebagai string jika bukan 6
                }
            }
        },
              {
                  data: 'tgl_pembayaran',
                  name: 'Tanggal Transaksi'
              },
              {
                  data: 'total',
                  name: 'total'
              },
              {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  searcable: false,
                  width: '15%'
              },
          ]
      });
  
  
      // Edit Task Modal
      $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
          var id = button.data('id');
          var tagihan_id = button.data('tagihan_id'); // Extract info from data-* attributes
          var user_id = button.data('user_id');
          var keterangan = button.data('keterangan');
          var tgl_pembayaran = button.data('tgl_pembayaran');
          var total = button.data('total');
          var status = button.data('status');
          var Pendapatan = button.data('Pendapatan');
          var modal = $(this);
          modal.find('#id').val(id);
          modal.find('#tagihan_id').val(tagihan_id);
          modal.find('#user_id').val(user_id);
          modal.find('#keterangan').val(keterangan);
          modal.find('#tgl_pembayaran').val(tgl_pembayaran);
          modal.find('#total').val(total);
          modal.find('#status').val(status);
          modal.find('#Pendapatan').val(Pendapatan);
      });
  
      $('#editTaskForm').on('submit', function(e) {
    e.preventDefault();
// console.log(bukti_transaksi);
    // Validasi di sini (pastikan semua field yang diperlukan diisi)

    var confirmation = confirm('Anda yakin ingin menyimpan perubahan?');

    if (confirmation) {
        var formData = new FormData(this); // Buat objek FormData dari formulir

        var transaksi_id = $('#id').val();
        // console.log('Data yang akan dikirim:', bukti_transaksi);
        // Tambahkan transaksi_id ke FormData (opsional, bergantung pada kebutuhan server)
        formData.append('transaksi_id', transaksi_id);

        $.ajax({
            url: '/data-danabos/' + transaksi_id,
            type: 'POST',
            data: formData,
            contentType: false, // Tidak atur contentType untuk FormData
            processData: false, // Tidak memproses FormData secara otomatis
            success: function(data) {
                alert('Data Berhasil Diubah');
                window.location.href = '/data-danabos';
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.responseJSON.message;
                alert('Terjadi Kesalahan: ' + errorMessage);
                window.location.href = '/data-danabos';
            }
        });
    }
});

  });
  </script>
@endpush