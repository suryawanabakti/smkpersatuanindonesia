<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\JadwalPpdb;
use Illuminate\Http\Request;

class JadwalPpdbController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPpdb::latest()->get();
        return view('panitia.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        return view('panitia.jadwal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'nullable|string',
        ]);

        JadwalPpdb::create($request->all());

        return redirect()->route('panitia.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit(JadwalPpdb $jadwal)
    {
        return view('panitia.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, JadwalPpdb $jadwal)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'nullable|string',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('panitia.jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy(JadwalPpdb $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('panitia.jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }
}
