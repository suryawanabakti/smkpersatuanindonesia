<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Payment;
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
        $payment = Payment::where('user_id', $user->id)->first();
        if (!$payment) {
            return redirect()->route('student.formulir.edit')->with('error', 'Cetak formulir bisa dilakukan ketika pembayaran sdh dilakukan.');
        }
        if ($payment->status !== 'paid') {
            return redirect()->route('student.formulir.edit')->with('error', 'Cetak formulir bisa dilakukan ketika pembayaran sdh dilakukan.');
        }
        if (!$siswa) {
            return redirect()->route('student.formulir.edit')->with('error', 'Data pendaftaran tidak ditemukan.');
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

        /**
         * ==========================
         * VALIDATION RULES
         * ==========================
         */
        $rules = [
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
            'kip' => 'file|mimes:jpeg,png,jpg,pdf|max:2048',
        ];

        /**
         * ==========================
         * UPLOAD RULES DINAMIS
         * ==========================
         */
        $uploadFields = [
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'kartu_keluarga' => 'file|mimes:jpeg,png,jpg,pdf|max:2048',
            'akte_kelahiran' => 'file|mimes:jpeg,png,jpg,pdf|max:2048',
            'ijazah' => 'file|mimes:jpeg,png,jpg,pdf|max:2048',

        ];

        foreach ($uploadFields as $field => $rule) {
            // Jika file belum ada di DB → required
            // Jika sudah ada → nullable
            $rules[$field] = ($siswa->$field ? 'nullable|' : 'required|') . $rule;
        }

        $request->validate($rules);

        /**
         * ==========================
         * DATA NON FILE
         * ==========================
         */
        $data = $request->except([
            'foto',
            'kartu_keluarga',
            'akte_kelahiran',
            'ijazah',
            'kip',
            '_token',
            '_method'
        ]);

        /**
         * ==========================
         * HANDLE FILE UPLOAD
         * ==========================
         */
        foreach (array_keys($uploadFields) as $field) {
            if ($request->hasFile($field)) {

                // Hapus file lama
                if ($siswa->$field && Storage::disk('public')->exists($siswa->$field)) {
                    Storage::disk('public')->delete($siswa->$field);
                }

                // Simpan file baru
                $data[$field] = $request->file($field)
                    ->store('uploads/' . $field, 'public');
            }
        }

        /**
         * ==========================
         * UPDATE DATABASE
         * ==========================
         */
        PendaftaranSiswa::where('id', $siswa->id)->update($data);

        /**
         * ==========================
         * KIRIM WHATSAPP
         * ==========================
         */
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

        return back()->with('success', 'Formulir berhasil diperbarui.');
    }
}
