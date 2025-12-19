<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSiswa;
use Illuminate\Http\Request;

class PendaftaranSiswaController extends Controller
{
    public function index()
    {
        $siswas = PendaftaranSiswa::latest()->get();
        return view('panitia.pendaftaran.index', compact('siswas'));
    }

    public function show(PendaftaranSiswa $siswa)
    {
        return view('panitia.pendaftaran.show', compact('siswa'));
    }

    public function verify(Request $request, PendaftaranSiswa $siswa)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
        ]);

        $siswa->update(['status' => $request->status]);

        return redirect()->route('panitia.pendaftaran.show', $siswa)->with('success', 'Status pendaftaran berhasil diperbarui');
    }
}
