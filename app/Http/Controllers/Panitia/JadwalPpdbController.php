<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\JadwalPpdb;
use Illuminate\Http\Request;

class JadwalPpdbController extends Controller
{
    public function index()
    {
        // Allow if user can view OR manage
        if (!auth()->user()->can('view jadwal ppdb') && !auth()->user()->can('manage jadwal ppdb')) {
            abort(403);
        }
        $jadwals = JadwalPpdb::latest()->get();
        return view('panitia.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $this->authorize('manage jadwal ppdb');
        return view('panitia.jadwal.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manage jadwal ppdb');
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        JadwalPpdb::create($data);

        return redirect()->route('panitia.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit(JadwalPpdb $jadwal)
    {
        $this->authorize('manage jadwal ppdb');
        return view('panitia.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, JadwalPpdb $jadwal)
    {
        $this->authorize('manage jadwal ppdb');
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $jadwal->update($data);

        return redirect()->route('panitia.jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy(JadwalPpdb $jadwal)
    {
        $this->authorize('manage jadwal ppdb');
        $jadwal->delete();
        return redirect()->route('panitia.jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }

    public function toggleStatus(JadwalPpdb $jadwal)
    {
        $this->authorize('manage jadwal ppdb');
        $jadwal->update(['is_active' => !$jadwal->is_active]);

        $statusText = $jadwal->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('panitia.jadwal.index')->with('success', "Jadwal berhasil {$statusText}");
    }
}
