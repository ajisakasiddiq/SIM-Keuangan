@extends('layouts.app')
@section('title')
    Dashboard | Data Siswa
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Siswa</h1>
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
                            <a href="" type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#adduser">
                                + Tambah Data
                            </a>
                            <a href=""  type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#import">
                                + Import Data Siswa
                            </a>
                            <a href=""  type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#naik">
                                + Naik Kelas Siswa
                            </a>
                            
                            <div class="table-responsive">
                              <table class="table-hover scroll-horizontal-vertical w-100" id="siswa">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>NIK</th>
                                            <th>No HP</th>
                                            <th>Alamat</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                      <tbody>
                                      </tbody>
                                    </div>                              
                                    <tfoot>
                                        <tr>
                                          <th>No</th>
                                          <th>Foto</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>NIK</th>
                                          <th>No HP</th>
                                          <th>Alamat</th>
                                          <th>Tempat Lahir</th>
                                          <th>Tanggal Lahir</th>
                                          <th>Jenis Kelamin</th>
                                          <th>Kelas</th>
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
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Nama</label>
                          <input type="text" name="name" class="form-control" id="name"
                              aria-describedby="emailHelp">
                          <input type="hidden" name="id" class="form-control" id="id"
                              aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Email</label>
                          <input type="text" name="email" class="form-control" id="email"
                              aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">NIK</label>
                          <input type="text" name="nik" class="form-control" id="nik"
                              aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">NO HP</label>
                          <input type="text" name="no_hp" class="form-control" id="no_hp"
                              aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Alamat</label>
                          <input type="text" name="alamat" class="form-control" id="alamat"
                              aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
                          <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"
                              aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
                          <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir"
                              aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                          <select class="form-control" name="jk" id="jk">
                            <option value="L">L</option>
                            <option value="P">P</option>
                        </select>
                      </div>
                      <div class="mb-3">
                          <label for="kelas" class="form-label">Kelas</label>
                          <select class="form-control" name="kelas" id="kelas">
                            <option value="VII">VII</option>
                            <option value="VIII">VIII</option>
                            <option value="IX">IX</option>
                        </select>
                      </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" id="btn-edit"  class="btn btn-primary">Save changes</button>
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
              <h4 class="modal-title bold fs-3" id="exampleModalLabel">{{ __('Tambah User') }}</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('data-siswa.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input id="password" type="hidden" value="12345678" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                      <input id="role" type="hidden" value="siswa" class="form-control @error('password') is-invalid @enderror" name="role" required autocomplete="new-password">
                    </div> <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control" id="nik"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">NO HP</label>
                        <input type="text" name="no_hp" class="form-control" id="no_hp"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="alamat"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                        <select class="form-control" name="jk" id="">
                            <option value="L">Laki - Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select class="form-control" name="kelas" id="kelas">
                          <option value="VII">VII</option>
                          <option value="VIII">VIII</option>
                          <option value="IX">IX</option>
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
{{-- end modal add --}}
{{-- import data --}}
<div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="exampleModalLabel">Impor File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('data-siswa.importData') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Import Data</label>
                         <input type="file" name="excel_file">
                         <br>
                         <small>*Max 10.000 data</small>
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
<div class="modal fade" id="naik" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="exampleModalLabel">Impor File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update.class') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <h3 for="exampleInputEmail1" class="form-label">Yakin Update Kelas ini?</h3>
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


</div>
@endsection
@push('addon-script')
<script type="text/javascript">
  // crud
  $(document).ready(function() {
    var table=  $('#siswa').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ url()->current() }}',
          columns: [
              {
                  data: 'no',
                  name: 'no'
              },
              {
                  data: 'profile',
                  name: 'Foto'
              },
              {
                  data: 'name',
                  name: 'name'
              },
              {
                  data: 'email',
                  name: 'email'
              },
              {
                  data: 'nik',
                  name: 'NIK'
              },
              {
                  data: 'no_hp',
                  name: 'No HP'
              },
              {
                  data: 'alamat',
                  name: 'alamat'
              },
              {
                  data: 'tempat_lahir',
                  name: 'Tempat Lahir'
              },
              {
                  data: 'tgl_lahir',
                  name: 'tanggal Lahir'
              },
              {
                  data: 'jk',
                  name: 'Jenis Kelamin'
              },
              {
                  data: 'kelas',
                  name: 'Kelas'
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
          var id = button.data('id'); // Extract info from data-* attributes
          var name = button.data('name');
          var email = button.data('email');
          var nik = button.data('nik');
          var no_hp = button.data('no_hp');
          var alamat = button.data('alamt');
          var tempat_lahir = button.data('tempat_lahir');
          var tgl_lahir = button.data('tgl_lahir');
          var jk = button.data('jk');
          var kelas = button.data('kelas');
          var modal = $(this);
          modal.find('#id').val(id);
          modal.find('#name').val(name);
          modal.find('#email').val(email);
          modal.find('#nik').val(nik);
          modal.find('#no_hp').val(no_hp);
          modal.find('#alamat').val(alamat);
          modal.find('#tempat_lahir').val(tempat_lahir);
          modal.find('#tgl_lahir').val(tgl_lahir);
          modal.find('#jk').val(jk);
          modal.find('#kelas').val(kelas);
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
              url: '/data-siswa/' + transaksi_id,
              type: 'POST',
              data: formData,
              success: function(data) {
                  alert('Data Berhasil Di ubah',data);
                  window.location.href = '/data-siswa';
              },
              error: function(data) {
                  alert('Error',data);
                  window.location.href = '/data-siswa';
              }
          });
      }
  });
  });
  </script>
@endpush