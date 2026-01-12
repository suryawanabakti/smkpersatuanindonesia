<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSiswa;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FormulirController extends Controller
{

    protected $whatsappService;
    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }
    public function edit()
    {
        $user = Auth::user();
        $siswa = $user->pendaftaran;

        if (!$siswa) {
            return redirect()->route('dashboard')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        return view('student.formulir.edit', compact('siswa'));
    }

    public function print()
    {
        $user = Auth::user();
        $siswa = $user->pendaftaran;

        if (!$siswa) {
            return redirect()->route('dashboard')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        return view('student.formulir.print', compact('siswa'));
    }

    public function parentData()
    {
        $user = Auth::user();
        $siswa = $user->pendaftaran;

        if (!$siswa) {
            return redirect()->route('dashboard')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        return view('student.formulir.parent_data', compact('siswa'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $siswa = $user->pendaftaran;

        if (!$siswa) {
            return back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        // if ($siswa->status !== 'pending') {
        //     return back()->with('error', 'Maaf, formulir tidak dapat dicek karena status pendaftaran sudah ' . $siswa->status . '.');
        // }

        $request->validate([
            // Data Diri
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'nisn' => 'required|string|max:20|unique:pendaftaran_siswas,nisn,' . $siswa->id,
            'asal_sekolah' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jurusan_pilihan' => 'required|string',

            // Data Orang Tua
            'nama_wali' => 'required|string|max:255',
            'pekerjaan_wali' => 'required|string|max:255',
            'penghasilan_wali' => 'required|string',
            'alamat_wali' => 'required|string',
            'no_hp_orang_tua' => 'required|string|max:20',

            // Uploads
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kartu_keluarga' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'akte_kelahiran' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'ijazah' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'kip' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $data = $request->except(['foto', 'kartu_keluarga', 'akte_kelahiran', 'ijazah', 'kip', '_token', '_method']);

        // Handle File Uploads
        $uploadFields = ['foto', 'kartu_keluarga', 'akte_kelahiran', 'ijazah', 'kip'];

        foreach ($uploadFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($siswa->$field && Storage::exists('public/' . $siswa->$field)) {
                    Storage::delete('public/' . $siswa->$field);
                }

                // Store new file
                $path = $request->file($field)->store('uploads/' . $field, 'public');
                $data[$field] = $path;
            }
        }

        $message = "Assalamu’alaikum Wr. Wb.\n\n"
            . "Yth. Bapak/Ibu Orang Tua/Wali,\n\n"
            . "Kami informasikan bahwa formulir pendaftaran peserta didik atas nama "
            . $request->nama_lengkap
            . " telah berhasil diperbarui pada sistem pendaftaran sekolah kami.\n\n"
            . "Silakan menunggu proses verifikasi data dari panitia PPDB. "
            . "Apabila terdapat kekurangan atau kesalahan data, kami akan menghubungi Bapak/Ibu kembali.\n\n"
            . "Terima kasih atas perhatian dan kerja samanya.\n\n"
            . "Panitia PPDB";

        $this->whatsappService->send($request->no_hp_orang_tua, $message);
        PendaftaranSiswa::where('id', $siswa->id)->update($data);

        return back()->with('success', 'Formulir berhasil diperbarui.');
    }
}
