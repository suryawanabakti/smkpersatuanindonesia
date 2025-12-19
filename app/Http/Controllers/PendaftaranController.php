<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranSiswa;
use App\Models\User;
use App\Services\WhatsappService;
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
            'nisn' => ['required', 'string', 'unique:pendaftaran_siswas', 'max:20'],
            'asal_sekolah' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_hp' => ['required', 'string', 'max:20'],
            'no_hp_orang_tua' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string'],
            'jurusan_pilihan' => ['required', 'string'],
        ]);

        try {
            DB::beginTransaction();

            // 1. Create User
            $user = User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // 2. Create PendaftaranSiswa record
            $siswas = PendaftaranSiswa::create([
                'user_id' => $user->id,
                'nama_lengkap' => $request->nama_lengkap,
                'nisn' => $request->nisn,
                'asal_sekolah' => $request->asal_sekolah,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'no_hp_orang_tua' => $request->no_hp_orang_tua,
                'alamat' => $request->alamat,
                'jurusan_pilihan' => $request->jurusan_pilihan,
                'status' => 'pending',
            ]);

            // 3. Send WhatsApp Notification to Parent
            $message = "Halo, selamat! Pendaftaran siswa a.n. {$request->nama_lengkap} di SMK PERSATUAN INDONESIA MAROS telah berhasil dikirim. Mohon tunggu informasi selanjutnya.";
            WhatsappService::send($request->no_hp_orang_tua, $message);

            DB::commit();

            // 4. Auto Login
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Pendaftaran berhasil! Selamat datang.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage())->withInput();
        }
    }
}
