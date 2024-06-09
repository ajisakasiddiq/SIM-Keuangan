<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class getDataController extends Controller
{
    public function getSiswa($jurusan)
    {
        $siswa = User::where('role', 'siswa')
            ->where('jurusan', $jurusan)
            ->get();
        return response()->json($siswa);
    }
}
