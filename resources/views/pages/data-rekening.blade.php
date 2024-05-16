@extends('layouts.app')
@section('title')
    Dashboard | Data Rekening
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Rekening</h1>
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
                                <table id="UserDataTagihan" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Bank</th>
                                            <th>Atas Nama</th>
                                            <th>No Rekening</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tagihan as $data) 
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->nama_bank }}</td>
                                            <td>{{ $data->atas_nama }}</td>
                                            <td>{{ $data->norek }}</td>
                                            <td>
                                              <div class="btn-group">
                                                <div class="dropdown">
                                                  <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi</button>
                                                  <div class="dropdown-menu">
                                                  <button class="dropdown-item" data-toggle="modal" data-target="#editModal{{ $data->id }}">Edit</button>
                                                    <form action="{{ route('data-rekening.destroy', $data->id) }}" method="POST">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </td>
                                        </tr>
    <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-3" id="exampleModalLabel">{{ __('Edit User') }}</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('data-rekening.update',$data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Atas Nama</label>
                      <input id="name" type="hidden" class="form-control @error('name') is-invalid @enderror" name="jurusan" value="{{ $jurusan }}"  required autocomplete="name" autofocus>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="atas_nama" value="{{ $data->atas_nama }}" required autocomplete="name" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Nama Bank</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="nama_bank" value="{{ $data->nama_bank }}" required autocomplete="name" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">No Rekeningg</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="norek" value="{{ $data->norek }}" required autocomplete="name" autofocus>
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
@endforeach 
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                          <th>No</th>
                                          <th>Nama Bank</th>
                                          <th>Atas Nama</th>
                                          <th>No Rekening</th>
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

    {{-- modal add --}}
    <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title bold fs-3" id="exampleModalLabel">{{ __('Tambah Data Rekening') }}</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('data-rekening.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Atas Nama</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="atas_nama"  required autocomplete="name" autofocus>
                      <input id="name" type="hidden" class="form-control @error('name') is-invalid @enderror" name="jurusan" value="{{ $jurusan }}"  required autocomplete="name" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Nama Bank</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="nama_bank"  required autocomplete="name" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">No Rekeningg</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="norek"  required autocomplete="name" autofocus>
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
  $(document).ready(function() {
        $('#UserDataTagihan').DataTable();
    });
    </script>
@endpush