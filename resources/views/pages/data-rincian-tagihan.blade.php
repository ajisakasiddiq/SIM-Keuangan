@extends('layouts.app')
@section('title')
    Dashboard | Data Jenis Tagihan
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
     
        <h1 class="h3 mb-0 text-gray-800">Rincian Tagihan Siswa</h1>
      
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
                            <div class="row">
                              <div class="col-md-2">
                                  <label for="filter">Kategori :</label>
                                  <select id="filter-category" class="form-control">
                                    <option value="">Pilih kategori</option>
                                    @foreach ($tagihan as $item) 
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                 
                              </div>
                              <div class="col-md-2">
                                  <label for="filter">Tahun Ajaran :</label>
                                  <select id="filter-year" class="form-control">
                                    <option value="">Pilih Tahun Ajaran</option>
                                      <option value="option1">Option 1</option>
                                      <option value="option2">Option 2</option>
                                      <option value="option3">Option 3</option>
                                  </select>
                              </div>
                              </div>
                          <br>
                            <div class="table-responsive">
                              <table class="table-hover scroll-horizontal-vertical w-100" id="rincian">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($rincian as $data) 
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->total }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                     Aksi
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                    <li><a data-bs-toggle="modal" data-bs-target="#editUser{{ $data->id }}" class="dropdown-item">Tambah Rincian</a></li>
                                                    <li><a data-bs-toggle="modal" data-bs-target="#editUser{{ $data->id }}" class="dropdown-item">Edit</a></li>
                                                    <li><a data-bs-toggle="modal" data-bs-target="#deletedata{{$data->id}}" class="dropdown-item text-danger">Hapus</a></li>
                
                                                    </ul>
                                                  </div>
                                            </td>
                                        </tr> --}}
                                        
                                        
                                        {{-- modal edit --}}
    {{-- <div class="modal fade" id="editUser{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-3" id="exampleModalLabel">{{ __('Edit User') }}</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('data-rincian-tagihan.update',$data->id) }}" method="POST">
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
{{-- <div class="modal fade" id="deletedata{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{ route('data-rincian-tagihan.destroy', $data->id) }}" method="POST">
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


@endforeach  --}} 
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                          <th colspan="2" style="text-align:right">Total:</th>
                                          <th></th>
                                          <th></th>
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
                <form action="{{ route('data-rincian-tagihan.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  required autocomplete="name" autofocus>
                      @foreach ($tagihan as $item) 
                      <input id="id" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $item->id }}" name="tagihan_id"  required autocomplete="name" autofocus>
                      @endforeach
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Total</label>
                      <input id="total" type="text" class="form-control @error('total') is-invalid @enderror" name="total"  required autocomplete="total" autofocus>
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
    var table=  $('#rincian').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: '{{ url()->current() }}',
            data: function(d) {
                d.name = $('#filter-category').val();
                // d.min_age = $('#min-age-filter').val();
            }
        },
          columns: [
              {
                  data: 'no',
                  name: 'no'
              },
              {
                  data: 'name',
                  name: 'name'
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
      $('#filter-category').on('change', function() {
        table.ajax.reload();
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
{{-- <script>
  $(document).ready(function() {
      let dataTable = $('#UserDataTagihan').DataTable({
          "footerCallback": function (row, data, start, end, display) {
              let api = this.api();

              // Menghitung total semua data di kolom 'Total'
              let intVal = function (i) {
                  return typeof i === 'string' ?
                      i.replace(/[\$,]/g, '') * 1 :
                      typeof i === 'number' ?
                      i :
                      0;
              };

              // Total keseluruhan (total di semua halaman)
              let total = api
                  .column(2)
                  .data()
                  .reduce(function (a, b) {
                      return intVal(a) + intVal(b);
                  }, 0);

              // Total di halaman saat ini
              let pageTotal = api
                  .column(2, { page: 'current' })
                  .data()
                  .reduce(function (a, b) {
                      return intVal(a) + intVal(b);
                  }, 0);

              // Update footer dengan total
              $(api.column(2).footer()).html(
                  'Rp.' + pageTotal.toFixed(2) + ' ( Rp.' + total.toFixed(2) + ' total)'
              );
          }
      });

      // Implementasi filter berdasarkan kategori dan tahun ajaran
      $('#filter-category, #filter-year').change(function() {
          let category = $('#filter-category').val();
          let year = $('#filter-year').val();

          // Implementasikan logika untuk memfilter data di DataTable berdasarkan kategori dan tahun ajaran yang dipilih
          // Anda perlu mengirim request AJAX untuk mendapatkan data sesuai dengan filter yang dipilih
          // Contoh:
          // dataTable.clear().draw();
          // dataTable.rows.add(filteredData).draw();
      });
  });
</script> --}}
@endpush