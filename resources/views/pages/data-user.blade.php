@extends('layouts.app')
@section('title')
    Dashboard | Data User
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data User</h1>
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
                            
                            <div class="table-responsive">
                              <table class="table-hover scroll-horizontal-vertical w-100" id="siswa">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>role</th>
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
            </div>
        </div>
    {{-- </div> --}}
    <div class="modal fade" id="editModal" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-3" id="exampleModalLabel">Edit User
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
                        <select name="role" class="form-control" id="role">
                            <option value="bendahara-excellent">Bendahara Excellent</option>
                            <option value="bendahara-reguler">Bendahara Reguler</option>
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
                <form action="{{ route('data-user.store') }}" method="POST">
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
                      {{-- <label for="password" class="form-label">Password</label> --}}
                      <input id="password" type="hidden" value="12345678" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    </div>
                    <div class="mb-3">
                        <label for="role">Role</label>
                        <select name="role" class="form-control" id="role">
                            <option value="bendahara-excellent">Bendahara Excellent</option>
                            <option value="bendahara-reguler">Bendahara Reguler</option>
                        </select>
                      </div>
                      <small>sandi default (12345678)</small>
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
                  data: 'role',
                  name: 'role'
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
              url: '/data-user/' + transaksi_id,
              type: 'POST',
              data: formData,
              success: function(data) {
                  alert('Data Berhasil Di ubah',data);
                  window.location.href = '/data-user';
              },
              error: function(data) {
                  alert('Error',data);
                  window.location.href = '/data-user';
              }
          });
      }
  });
  });
  </script>
@endpush