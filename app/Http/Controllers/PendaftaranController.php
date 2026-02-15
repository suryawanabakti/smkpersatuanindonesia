<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranSiswa;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('pendaftaran.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'jurusan_pilihan' => ['required', 'string'],
        ]);

        // Check Jadwal PPDB
        $now = now()->toDateString();
        $jadwal = \App\Models\JadwalPpdb::where('tanggal_mulai', '<=', $now)
            ->where('tanggal_selesai', '>=', $now)
            ->first();

        if (!$jadwal) {
            return back()->with('error', 'Pendaftaran saat ini sedang ditutup. Silakan cek jadwal pendaftaran.')->withInput();
        }

        try {
            DB::beginTransaction();

            // 1. Create User
            $user = User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // 2. Generate Unique No Pendaftaran
            $year = date('Y');
            $jurusan = $request->jurusan_pilihan;

            // Count existing registrations for this jurusan and year
            $count = PendaftaranSiswa::where('jurusan_pilihan', $jurusan)
                ->whereYear('created_at', $year)
                ->count() + 1;

            $no_pendaftaran = "{$jurusan}-{$year}{$count}";

            // 3. Create PendaftaranSiswa record
            $siswa = PendaftaranSiswa::create([
                'user_id' => $user->id,
                'no_pendaftaran' => $no_pendaftaran,
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'jurusan_pilihan' => $request->jurusan_pilihan,
                'status' => 'pending',
            ]);

            DB::commit();

            // 4. Notify Panitiaa
            User::notifyPanitia(new \App\Notifications\StudentRegisteredNotification($siswa));

            // 5. Auto Login
            Auth::login($user);

            return redirect()->route('student.formulir.edit')->with('success', 'Pendaftaran berhasil! Silakan lengkapi formulir Anda.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage())->withInput();
        }
    }
}
