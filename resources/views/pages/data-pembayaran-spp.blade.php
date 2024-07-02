@extends('layouts.app')
@section('title')
    Dashboard | Data Tagihan Siswa
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Tagihan SPP</h1>
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
                            <a href="" class="btn btn-primary mb-3" type="button"  data-bs-toggle="modal" data-bs-target="#adduser">
                                + Tagihan Berdasarkan Siswa
                            </a>
                            <a href="" class="btn btn-primary mb-3" type="button"  data-bs-toggle="modal" data-bs-target="#adduserkelas">
                                + Tagihan Berdasarkan Kelas
                            </a>
                            <div class="table-responsive">
                              <table class="table-hover scroll-horizontal-vertical w-100" id="tagihan">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Kelas Siswa</th>
                                            <th>bukti_transaksi</th>
                                            <th>date_awal</th>
                                            <th>date_akhir</th>
                                            <th>Total</th>
                                            <th>keterangan</th>
                                            <th>status</th>
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
                  <h1 class="modal-title fs-3" id="exampleModalLabel">Edit Transaksi
                  </h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="editTaskForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="tagihan_id" value="1" id="tagihan_id">
                    <input type="hidden" name="id" value="1" id="id">
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
                      <label for="keterangan" class="form-label">Bulan</label>
                      <input id="keterangan" type="text" class="form-control @error('name') is-invalid @enderror" name="keterangan" autofocus>
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




  {{-- modal add berdasarkan kelas --}}
  <div class="modal fade bd-example-modal-lg" id="adduserkelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title bold fs-3" id="exampleModalLabel">{{ __('Tambah Tagihan') }}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('data-tagihan-spp.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="status" class="form-control" id="status"
                        aria-describedby="emailHelp" value="0">
                    <input type="hidden" name="jenis_transaksi" class="form-control" id="jenis_transaksi"
                        aria-describedby="emailHelp" value="Pendapatan">
                        <input type="hidden" name="tagihan_id" value="1">
                        @if(Auth::user()->role == 'bendahara-excellent')
                        <input type="hidden" name="jurusan" id="jurusan" value="excellent">
                        @else
                        <input type="hidden" name="jurusan" id="jurusan" value="reguler">
                        @endif
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-control" name="kelas" id="kelas">
                                <option value="VII">VII</option>
                                <option value="VIII">VIII</option>
                                <option value="IX">IX</option>
                            </select>
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
                            <label for="tahunajar" class="form-label">Tahun Ajaran</label>
                           
                            <select class="form-control" name="tahunajar" id="tahunajar">
                                <option value="">Pilih Tahun Ajaran</option>
                                @foreach ($tahun as $item)
                                <option value="{{ $item->tahunawal }}/{{ $item->tahunakhir }}">{{ $item->tahunawal }}/{{ $item->tahunakhir }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
              
                <div class="col-md-6">
                    <small>Macam Tagihan</small>
                    <hr>
                    <div id="entriesContainer">
                        <!-- Container untuk field-field entri -->
                    </div>
                
                    <button type="button" id="addEntryButton" class="btn btn-primary">+</button>
                </div>
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
  
  {{-- modal add by siswa --}}
  <div class="modal fade bd-example-modal-lg" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title bold fs-3" id="exampleModalLabel">{{ __('Tambah Tagihan') }}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('data-tagihan-spp.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="status" class="form-control" id="status"
                        aria-describedby="emailHelp" value="0">
                    <input type="hidden" name="jenis_transaksi" class="form-control" id="jenis_transaksi"
                        aria-describedby="emailHelp" value="Pendapatan">
                        <input type="hidden" name="tagihan_id" value="1">
                        @if(Auth::user()->role == 'bendahara-excellent')
                        <input type="hidden" name="jurusan" id="jurusan" value="excellent">
                        @else
                        <input type="hidden" name="jurusan" id="jurusan" value="reguler">
                        @endif
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Nama Siswa</label>
                            <select class="form-control" name="user_id" id="user_id">
                                <option value="">Pilih Siswa</option>
                                @foreach ($siswa as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}({{ $item->nisn }})</option>
                                @endforeach
                            </select>
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
                            <label for="tahunajar" class="form-label">Tahun Ajaran</label>
                            <select class="form-control" name="tahunajar" id="tahunajar">
                                <option value="">Pilih Tahun Ajaran</option>
                                @foreach ($tahun as $item)
                                <option value="{{ $item->tahunawal }}/{{ $item->tahunakhir }}">{{ $item->tahunawal }}/{{ $item->tahunakhir }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
              
                <div class="col-md-6">
                    <small>Macam Tagihan</small>
                    <hr>
                    <div id="entries">
                        <!-- Container untuk field-field entri -->
                    </div>
                
                    <button type="button" id="addEntry" class="btn btn-primary">+</button>
                </div>
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
{{-- end modal add spp by siswa --}}

{{-- modal details transaksi --}}
<!-- Modal untuk menampilkan bukti transaksi -->
<div class="modal fade" id="transaksiModal" tabindex="-1" role="dialog" aria-labelledby="transaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transaksiModalLabel">Bukti Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="buktiTransaksiImg" src="" alt="Bukti Transaksi" class="img-fluid">
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('addon-script')
<script type="text/javascript">
$(document).ready(function() {
        let inputIndex = 1;

        $('#addEntryButton').click(function() {
            const userId = $('#user_id').val();
            const dateAwal = $('#date_awal').val();
            const dateAkhir = $('#date_akhir').val();
            const jurusan = $('#jurusan').val();
            const tagihan_id = $('#tagihan_id').val();
            const jenis_transaksi = $('#jenis_transaksi').val();
            const status = $('#status').val();
            const tahunajar = $('#tahunajar').val();

            const inputHtml = `
            <div class="row">
                        <div class="col-md-6">
                <div class="mb-3">
                    <label for="keterangan${inputIndex}" class="form-label">Bulan</label>
                   <select class="form-control" name="keterangan[]" id="keterangan${inputIndex}">
            <option>Pilih Bulan</option>
            <option value="Januari">Januari</option>
            <option value="Februari">Februari</option>
            <option value="Maret">Maret</option>
            <option value="April">April</option>
            <option value="Mei">Mei</option>
            <option value="Juni">Juni</option>
            <option value="Juli">Juli</option>
            <option value="Agustus">Agustus</option>
            <option value="September">September</option>
            <option value="Oktober">Oktober</option>
            <option value="November">November</option>
            <option value="Desember">Desember</option>
        </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="total${inputIndex}" class="form-label">Nominal</label>
                    <input type="text" class="form-control" name="total[]" id="total${inputIndex}">
                </div>
            </div>
            `;

            $('#entriesContainer').append(inputHtml);
            inputIndex++;
        });
    });
$(document).ready(function() {
        let inputIndex = 1;

        $('#addEntry').click(function() {
            const userId = $('#user_id').val();
            const dateAwal = $('#date_awal').val();
            const dateAkhir = $('#date_akhir').val();
            const jurusan = $('#jurusan').val();
            const tagihan_id = $('#tagihan_id').val();
            const jenis_transaksi = $('#jenis_transaksi').val();
            const status = $('#status').val();
            const tahunajar = $('#tahunajar').val();

            const inputHtml = `
            <div class="row">
                        <div class="col-md-6">
                <div class="mb-3">
                    <label for="keterangan${inputIndex}" class="form-label">Bulan</label>
                    <select class="form-control" name="keterangan[]" id="keterangan${inputIndex}">
            <option>Pilih Bulan</option>
            <option value="Januari">Januari</option>
            <option value="Februari">Februari</option>
            <option value="Maret">Maret</option>
            <option value="April">April</option>
            <option value="Mei">Mei</option>
            <option value="Juni">Juni</option>
            <option value="Juli">Juli</option>
            <option value="Agustus">Agustus</option>
            <option value="September">September</option>
            <option value="Oktober">Oktober</option>
            <option value="November">November</option>
            <option value="Desember">Desember</option>
        </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="total${inputIndex}" class="form-label">Nominal</label>
                    <input type="number" class="form-control" name="total[]" id="total${inputIndex}">
                </div>
            </div>
            `;

            $('#entries').append(inputHtml);
            inputIndex++;
        });
    });





 $(document).ready(function() {
        // Mengatur event click pada tautan view-transaksi
        $('.view-transaksi').click(function(e) {
            e.preventDefault();

            // Mengambil ID transaksi dari atribut data-transaksi-id
            var transaksiId = $(this).data('transaksi-id');

            // Mengirim permintaan AJAX untuk mendapatkan URL gambar bukti transaksi
            $.ajax({
                url: '/get-transaksi-image/' + transaksiId,
                type: 'GET',
                success: function(response) {
                    // Memperbarui atribut src gambar pada modal dengan URL gambar yang diterima
                    $('#buktiTransaksiImg').attr('src', response.image_url);

                    // Menampilkan modal
                    $('#transaksiModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat memuat bukti transaksi.');
                }
            });
        });
    });
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
                  data: 'user.name',
                  name: 'Nama Siswa'
              },
              {
                  data: 'user.kelas',
                  name: 'Kelas Siswa'
              },
              {
                  data: 'bukti_transaksi',
                  name: 'bukti_transaksi'
              },
              {
                  data: 'date_awal',
                  name: 'date_awal'
              },
              {
                  data: 'date_akhir',
                  name: 'date_akhir'
              },
              {
                  data: 'total',
                  name: 'total'
              },
              
              {
                  data: 'keterangan',
                  name: 'keterangan'
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
              url: '/data-tagihan-spp/' + transaksi_id,
              type: 'POST',
              data: formData,
              success: function(data) {
                  alert('Data Berhasil Di ubah',data);
                  window.location.href = '/data-tagihan-spp';
              },
              error: function(xhr, status, error) {
        // Tangkap pesan error yang lebih spesifik dari responseJSON
        var errorMessage = xhr.responseJSON.message; // Ambil pesan error dari responseJSON

        // Tampilkan pesan error dalam alert atau console.log()
        alert('Terjadi Kesalahan: ' + errorMessage);
                  window.location.href = '/data-tagihan-spp';
              }
          });
      }
  });
  });
  </script>
@endpush