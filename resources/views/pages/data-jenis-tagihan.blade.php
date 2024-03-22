@extends('layouts.app')
@section('title')
    Dashboard | Data Jenis Tagihan
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Jenis Tagihan</h1>
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
                                <table id="UserDataTagihan" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tagihan as $data) 
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                     Aksi
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                    <li><a data-bs-toggle="modal" data-bs-target="#editUser{{ $data->id }}" class="dropdown-item">Edit</a></li>
                                                    <li><a data-bs-toggle="modal" data-bs-target="#deletedata{{$data->id}}" class="dropdown-item text-danger">Hapus</a></li>
                
                                                    </ul>
                                                  </div>
                                            </td>
                                        </tr>
                                        
                                        
                                        {{-- modal edit --}}
    <div class="modal fade" id="editUser{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-3" id="exampleModalLabel">{{ __('Edit User') }}</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('data-jenis-tagihan.update',$data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name }}" required autocomplete="name" autofocus>
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

{{-- modal delete --}}
<div class="modal fade" id="deletedata{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{ route('data-jenis-tagihan.destroy', $data->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <p>Anda Yakin akan menghapus data {{ $data->name }}?</p>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Hapus</button>
      </form>

      </div>
    </div>
  </div>
</div>


@endforeach 
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
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
              <h4 class="modal-title bold fs-3" id="exampleModalLabel">{{ __('Tambah User') }}</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('data-jenis-tagihan.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
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