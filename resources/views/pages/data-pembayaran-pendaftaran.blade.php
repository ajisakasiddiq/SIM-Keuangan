@extends('layouts.app')
@section('title')
    Dashboard | Data Tagihan Siswa
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Tagihan Pendaftaran Siswa</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
        <div class="dashboard-content mb-3">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="" class="btn btn-primary mb-3" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adduser">
                                + Tambah Data
                            </a>
                            <div class="table-responsive">
                              <table class="table-hover scroll-horizontal-vertical w-100" id="tagihan">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Kelas Siswa</th>
                                            <th>Total</th>
                                            <th>status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                      <tbody>
                                      </tbody>
                                    </div>                              
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Kelas Siswa</th>
                                            <th>Total</th>
                                            <th>status</th>
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
                <form id="editTaskForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="tagihan_id" value="3" id="tagihan_id">
                    <input type="hidden" name="id" id="id">
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
                      <label for="tahunajar" class="form-label">Tahun Ajaran</label>
                      <input id="tahunajar" type="text" class="form-control @error('tahunajar') is-invalid @enderror" name="tahunajar" autofocus>
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
                <form action="{{ route('data-tagihan-Pendaftaran.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="tagihan_id" value="3">
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
                        <label for="tahunajar" class="form-label">Tahun Ajaran</label>
                        <input id="tahunajar" type="text" class="form-control @error('tahunajar') is-invalid @enderror" name="tahunajar" autofocus>
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
                  data: 'name',
                  name: 'Nama Siswa'
              },
              {
                  data: 'kelas',
                  name: 'Kelas Siswa'
              },
              {
                  data: 'total_sum',
                  name: 'total'
              },
              {
                  data: 'status',
                  name: 'status'
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
          var date_awal = button.data('date_awal');
          var date_akhir = button.data('date_akhir');
          var total = button.data('total');
          var status = button.data('status');
          var jurusan = button.data('jurusan');
          var Pendapatan = button.data('Pendapatan');
          var tahunajar = button.data('tahunajar');
          var modal = $(this);
          modal.find('#id').val(id);
          modal.find('#tagihan_id').val(tagihan_id);
          modal.find('#user_id').val(user_id);
          modal.find('#keterangan').val(keterangan);
          modal.find('#date_awal').val(date_awal);
          modal.find('#date_akhir').val(date_akhir);
          modal.find('#total').val(total);
          modal.find('#status').val(status);
          modal.find('#jurusan').val(jurusan);
          modal.find('#Pendapatan').val(Pendapatan);
          modal.find('#tahunajar').val(tahunajar);
      });
  
      // Submit Edit Task Form
      $('#editTaskForm').on('submit', function(e) {
      e.preventDefault();
  
      // Tambahkan validasi di sini (misalnya, pastikan semua field yang diperlukan diisi)
  
      // Tampilkan konfirmasi kepada pengguna
      var confirmation = confirm('Anda yakin ingin menyimpan perubahan?');
  
      if (confirmation) {
          var formData = $(this).serialize();
          var transaksi_id = $('#id').val();
  
          $.ajax({
              url: '/data-tagihan-Pendaftaran/' + transaksi_id,
              type: 'POST',
              data: formData,
              success: function(data) {
                  alert('Data Berhasil Di ubah',data);
                  window.location.href = '/data-tagihan-Pendaftaran';
              },
              error: function(xhr, status, error) {
        // Tangkap pesan error yang lebih spesifik dari responseJSON
        var errorMessage = xhr.responseJSON.message; // Ambil pesan error dari responseJSON

        // Tampilkan pesan error dalam alert atau console.log()
        alert('Terjadi Kesalahan: ' + errorMessage);
                  window.location.href = '/data-tagihan-Pendaftaran';
              }
          });
      }
  });
  });
  </script>
@endpush