@extends('layouts.app')

@section('title')
    Dashboard | Data SAP
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Saldo SAP</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
    <div class="dashboard-content mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="" class="btn btn-primary mb-3" type="button" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#adduser">
                            + Tambah File
                        </a>
                        <a href="" class="btn btn-success mb-3" type="button" class="btn btn-primary"
                        data-bs-toggle="modal" data-bs-target="#import">
                        + import file
                    </a>
                        <div class="table-responsive">
                            <table id="UserData" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                             
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- </div> --}}


    {{-- modal edit --}}
    <div class="modal fade" id="editModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="exampleModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTaskForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <input type="id" id="id" name="id" hidden>
                            <label for="exampleInputEmail1" class="form-label">Company
                                Code</label>
                            <input type="text"
                                name="comp_code" class="form-control"
                                id="comp_code" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="code_desc" class="form-label">Code
                                Description</label>
                            <input type="text"
                                name="code_desc" class="form-control" id="code_desc"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="plant" class="form-label">Plant</label>
                            <input type="text" name="plant"
                                class="form-control" id="plant" required>
                        </div>

                        <div class="mb-3">
                            <label for="plant_desc" class="form-label">Plant
                                Description</label>
                            <input type="text"
                                name="plant_desc" class="form-control" id="plant_desc">
                        </div>

                        <div class="mb-3">
                            <label for="sl_desc" class="form-label">Storage Location</label>
                            <input type="text"
                                name="sl_desc" class="form-control" id="storage_location">
                        </div>
                        <div class="mb-3">
                            <label for="sl_desc" class="form-label">SL
                                Description</label>
                            <input type="text"
                                name="sl_desc" class="form-control" id="sl_desc">
                        </div>

                        <div class="mb-3">
                            <label for="material_type" class="form-label">Material
                                Type</label>
                            <input type="text"
                                name="material_type" class="form-control"
                                id="material_type">
                        </div>

                        <div class="mb-3">
                            <label for="material_type_desc" class="form-label">Material
                                Type Description</label>
                            <input type="text"
                                name="material_type_desc" class="form-control"
                                id="material_type_desc">
                        </div>

                        <div class="mb-3">
                            <label for="material" class="form-label">Material</label>
                            <input type="text"
                                name="material" class="form-control" id="material">
                        </div>

                        <div class="mb-3">
                            <label for="material_desc" class="form-label">Material
                                Description</label>
                            <input type="text"
                                name="material_desc" class="form-control"
                                id="material_desc">
                        </div>

                        <div class="mb-3">
                            <label for="material_group" class="form-label">Material
                                Group</label>
                            <input type="text"
                                name="material_group" class="form-control"
                                id="material_group">
                        </div>

                        <div class="mb-3">
                            <label for="base_unit" class="form-label">Base Unit</label>
                            <input type="text"
                                name="base_unit" class="form-control" id="base_unit">
                        </div>

                        <div class="mb-3">
                            <label for="val_type" class="form-label">Valuation
                                Type</label>
                            <input type="text"
                                name="val_type" class="form-control" id="val_type">
                        </div>

                        <div class="mb-3">
                            <label for="u_stock" class="form-label">U Stock</label>
                            <input type="text"
                                name="u_stock" class="form-control" id="u_stock">
                        </div>

                        <div class="mb-3">
                            <label for="quality_stock" class="form-label">Quality
                                Stock</label>
                            <input type="text"
                                name="quality_stock" class="form-control"
                                id="quality_stock">
                        </div>

                        <div class="mb-3">
                            <label for="block_stocked" class="form-label">Block
                                Stocked</label>
                            <input type="text"
                                name="block_stocked" class="form-control"
                                id="block_stocked">
                        </div>

                        <div class="mb-3">
                            <label for="it_stock" class="form-label">IT Stock</label>
                            <input type="text"
                                name="it_stock" class="form-control" id="it_stock">
                        </div>

                        <div class="mb-3">
                            <label for="val_class" class="form-label">Valuation
                                Class</label>
                            <input type="text"
                                name="val_class" class="form-control" id="val_class">
                        </div>

                        <div class="mb-3">
                            <label for="val_desc" class="form-label">Valuation
                                Description</label>
                            <input type="text"
                                name="val_desc" class="form-control" id="val_desc">
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
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
                    <h3 class="modal-title fs-3" id="exampleModalLabel">Tambah Data SAP</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('guru.store') }}">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="comp_code" class="form-label">Company Code</label>
                            <input type="text" name="comp_code" class="form-control" id="comp_code" required>
                        </div>

                        <div class="mb-3">
                            <label for="code_desc" class="form-label">Code Description</label>
                            <input type="text" name="code_desc" class="form-control" id="code_desc" required>
                        </div>

                        <div class="mb-3">
                            <label for="plant" class="form-label">Plant</label>
                            <input type="text" name="plant" class="form-control" id="plant" required>
                        </div>

                        <div class="mb-3">
                            <label for="plant_desc" class="form-label">Plant Description</label>
                            <input type="text" name="plant_desc" class="form-control" id="plant_desc">
                        </div>

                        <div class="mb-3">
                            <label for="sl_desc" class="form-label">Storage Location</label>
                            <input type="text" name="sl_desc" class="form-control" id="storage_location">
                        </div>
                        <div class="mb-3">
                            <label for="sl_desc" class="form-label">SL Description</label>
                            <input type="text" name="sl_desc" class="form-control" id="sl_desc">
                        </div>

                        <div class="mb-3">
                            <label for="material_type" class="form-label">Material Type</label>
                            <input type="text" name="material_type" class="form-control" id="material_type">
                        </div>

                        <div class="mb-3">
                            <label for="material_type_desc" class="form-label">Material Type Description</label>
                            <input type="text" name="material_type_desc" class="form-control" id="material_type_desc">
                        </div>

                        <div class="mb-3">
                            <label for="material" class="form-label">Material</label>
                            <select data-live-search="true" id="pilihan"
                                class="selectpicker option form-control  form-select" name="material">
                                <option>Kode Material</option>
                             
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="materialDescription" class="form-label">Material Description</label>
                            <input type="text" name="material_desc" class="form-control" id="materialDescription"
                                aria-describedby="materialDescriptionHelp">
                        </div>
                        <div class="mb-3">
                            <label for="material_group" class="form-label">Material Group</label>
                            <input type="text" name="material_group" class="form-control" id="material_group">
                        </div>

                        <div class="mb-3">
                            <label for="base_unit" class="form-label">Base Unit</label>
                            <input type="text" name="base_unit" class="form-control" id="base_unit">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Valuation type</label>
                            <select data-live-search="true"
                                class="selectpicker option form-control  form-select" name="val_type" id="movement">
                                <option>Pilih Type</option>
                                <option value="BURSA">BURSA</option>
                                <option value="HAPUS">HAPUS</option>
                                <option value="NORMAL">NORMAL</option>
                                <option value="PRE-MEMORY">PRE-MEMORY</option>
                                <option value="RETROVIT">RETROVIT</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="u_stock" class="form-label">U Stock</label>
                            <input type="text" name="u_stock" class="form-control" id="u_stock">
                        </div>

                        <div class="mb-3">
                            <label for="quality_stock" class="form-label">Quality Stock</label>
                            <input type="text" name="quality_stock" class="form-control" id="quality_stock">
                        </div>

                        <div class="mb-3">
                            <label for="Block_stocked" class="form-label">Block Stocked</label>
                            <input type="text" name="block_stocked" class="form-control" id="block_stocked">
                        </div>

                        <div class="mb-3">
                            <label for="it_stock" class="form-label">IT Stock</label>
                            <input type="text" name="it_stock" class="form-control" id="it_stock">
                        </div>

                        <div class="mb-3">
                            <label for="val_class" class="form-label">Valuation Class</label>
                            <input type="text" name="val_class" class="form-control" id="val_class">
                        </div>

                        <div class="mb-3">
                            <label for="val_desc" class="form-label">Valuation Description</label>
                            <input type="text" name="val_desc" class="form-control" id="val_desc">
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
{{-- import data --}}
{{-- <div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="exampleModalLabel">Impor File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Sap.importExcel') }}" method="post" enctype="multipart/form-data">
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
</div> --}}



</div>
@endsection
@push('addon-script')
<script type="text/javascript">
    // change material desc
    $(document).ready(function() {
        $('#pilihan').on('change', function() {
            var selectedValue = $(this).val();
            $.ajax({
                url: '/get-data/' + selectedValue, // Ganti dengan rute yang sesuai di Laravel
                type: 'GET',
                success: function(response) {
                    $('#materialDescription').val(response
                        .data); // Ganti dengan atribut atau data yang ingin Anda tampilkan
                }
            });
        });
    });
    
    // datatables
    $(document).ready(function() {
      var table=  $('#UserData').DataTable({
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
                    name: 'nama'
                },
                {
                    data: 'email',
                    name: 'email'
                }
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
            var comp_code = button.data('comp_code'); // Extract info from data-* attributes
            var code_desc = button.data('code_desc'); // Extract info from data-* attributes
            var plant = button.data('plant'); // Extract info from data-* attributes
            var plant_desc = button.data('plant_desc'); // Extract info from data-* attributes
            var storage_location = button.data('storage_location'); // Extract info from data-* attributes
            var sl_desc = button.data('sl_desc'); // Extract info from data-* attributes
            var material_type = button.data('material_type'); // Extract info from data-* attributes
            var material_type_desc = button.data('material_type_desc'); // Extract info from data-* attributes
            var material = button.data('material'); // Extract info from data-* attributes
            var material_desc = button.data('material_desc'); // Extract info from data-* attributes
            var material_group = button.data('material_group'); // Extract info from data-* attributes
            var base_unit = button.data('base_unit'); // Extract info from data-* attributes
            var val_type = button.data('val_type'); // Extract info from data-* attributes
            var u_stock = button.data('u_stock'); // Extract info from data-* attributes
            var quality_stock = button.data('quality_stock'); // Extract info from data-* attributes
            var block_stocked = button.data('block_stocked'); // Extract info from data-* attributes
            var it_stock = button.data('it_stock'); // Extract info from data-* attributes
            var val_class = button.data('val_class'); // Extract info from data-* attributes
            var val_desc = button.data('val_desc');
    
            var modal = $(this);
            modal.find('#id').val(id);
            modal.find('#comp_code').val(comp_code);
            modal.find('#code_desc').val(code_desc);
            modal.find('#plant').val(plant);
            modal.find('#plant_desc').val(plant_desc);
            modal.find('#storage_location').val(storage_location);
            modal.find('#sl_desc').val(sl_desc);
            modal.find('#material_type').val(material_type);
            modal.find('#material_type_desc').val(material_type_desc);
            modal.find('#material').val(material);
            modal.find('#material_desc').val(material_desc);
            modal.find('#material_group').val(material_group);
            modal.find('#base_unit').val(base_unit);
            modal.find('#val_type').val(val_type);
            modal.find('#u_stock').val(u_stock);
            modal.find('#quality_stock').val(quality_stock);
            modal.find('#block_stocked').val(block_stocked);
            modal.find('#it_stock').val(it_stock);
            modal.find('#val_class').val(val_class);
            modal.find('#val_desc').val(val_desc);
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
                url: '/guru/' + transaksi_id,
                type: 'POST',
                data: formData,
                success: function(data) {
                    $('#editModal').hide();
                    $('.modal-backdrop').remove(); // Hapus overlay
                    table.ajax.reload();
                },
                error: function(xhr) {
                    // Handle error
                }
            });
        }
    });
    
    
    });
    </script>
@endpush