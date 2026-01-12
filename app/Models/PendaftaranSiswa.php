<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendaftaranSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_pendaftaran',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'nisn',
        'asal_sekolah',
        'email',
        'no_hp',
        'no_hp_orang_tua',
        'alamat',
        'nama_wali',
        'pekerjaan_wali',
        'alamat_wali',
        'penghasilan_wali',
        'jurusan_pilihan',
        'status',
        'foto',
        'kartu_keluarga',
        'akte_kelahiran',
        'ijazah',
        'kip',
        'status_konfirmasi',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
