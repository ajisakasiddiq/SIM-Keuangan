@extends('layouts.app')
@section('title')
    Dashboard | Data Rekening
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Tahun Ajaran</h1>
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
                                            <th>Tahun Awal</th>
                                            <th>Tahun Akhir</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tahun as $data) 
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->tahunawal }}</td>
                                            <td>{{ $data->tahunakhir }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td>
                                              <div class="btn-group">
                                                <div class="dropdown">
                                                  <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi</button>
                                                  <div class="dropdown-menu">
                                                  <button class="dropdown-item" data-toggle="modal" data-target="#editUser{{ $data->id }}">Edit</button>
                                                    <form action="{{ route('Tahun-Ajaran.destroy', $data->id) }}" method="POST">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </td>
                                        </tr>
                                        
                                        
                                        {{-- modal edit --}}
    <div class="modal fade" id="editUser{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-3" id="exampleModalLabel">{{ __('Edit Data') }}</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Tahun-Ajaran.update',$data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Tahun Awal</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="tahunawal" value="{{ $data->tahunawal }}" required autocomplete="name" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Tahun Akhir</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="nama_bank" value="{{ $data->tahunakhir }}" required autocomplete="name" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Status</label>
                      <select class="form-control" name="status" id="status">
                          <option value="Aktif" {{ $data->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                          <option value="Tidak Aktif" {{ $data->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
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
          <form action="{{ route('data-rekening.destroy', $data->id) }}" method="POST">
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
              <h4 class="modal-title bold fs-3" id="exampleModalLabel">{{ __('Tambah Data') }}</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Tahun-Ajaran.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Tahun Awal</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="tahunawal"  required autocomplete="name" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Tahun Akhir</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="tahunakhir"  required autocomplete="name" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Status</label>
                      <select class="form-control" name="status" id="">
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
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
</div>
@endsection
@push('addon-script')
<script type="text/javascript">
  $(document).ready(function() {
        $('#UserDataTagihan').DataTable();
    });
    </script>
@endpush