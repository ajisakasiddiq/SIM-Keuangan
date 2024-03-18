<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = User::query();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <div class="btn-group">
                      <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi</button>
                        <div class="dropdown-menu">
                        <button class="dropdown-item" 
                        data-id="' . $item->id . '" 
                        data-comp_code="' . $item->comp_code . '" 
                        data-code_desc="' . $item->code_desc . '" 
                        data-plant="' . $item->plant . '" 
                        data-plant_desc="' . $item->plant_desc . '" 
                        data-storage_location="' . $item->storage_location . '" 
                        data-sl_desc="' . $item->sl_desc . '" 
                        data-material_type="' . $item->material_type . '" 
                        data-material_type_desc="' . $item->material_type_desc . '" 
                        data-material="' . $item->material . '" 
                        data-material_desc="' . $item->material_desc . '" 
                        data-material_group="' . $item->material_group . '" 
                        data-base_unit="' . $item->base_unit . '" 
                        data-val_type="' . $item->val_type . '" 
                        data-u_stock="' . $item->u_stock . '" 
                        data-quality_stock="' . $item->quality_stock . '" 
                        data-block_stocked="' . $item->block_stocked . '" 
                        data-it_stock="' . $item->it_stock . '" 
                        data-val_class="' . $item->val_class . '" 
                        data-val_desc="' . $item->val_desc . '" 
                        data-mon_id="' . $item->mon_id . '" 
                        data-toggle="modal" data-target="#editModal">Edit</button>

                          <form action="' . route('guru.destroy', $item->id) . '" method="POST">
                          ' . method_field('delete') . csrf_field() . '
                          <button type="submit" class="dropdown-item text-danger">Hapus</button>
                          </form>
                        </div>
                      </div>
                    </div>
                    ';
                })
                ->addColumn('no', function ($item) {
                    static $counter = 1;
                    return $counter++;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('data-guru');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Simpan data ke database
            User::create($request->all());
            return redirect()->route('guru.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('guru.index')->with('error', 'Key yang anda masukkan tidak ada di saldo mon');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $item = User::findOrFail($id);
        $item->update($data);
        return redirect()->route('user.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('guru.index');
    }
}
