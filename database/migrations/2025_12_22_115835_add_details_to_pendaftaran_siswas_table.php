<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pendaftaran_siswas', function (Blueprint $table) {
            // Parent/Guardian Data
            $table->string('nama_wali')->nullable()->after('alamat');
            $table->string('pekerjaan_wali')->nullable()->after('nama_wali');
            $table->text('alamat_wali')->nullable()->after('pekerjaan_wali');
            $table->string('penghasilan_wali')->nullable()->after('alamat_wali');

            // Student Details
            $table->string('tempat_lahir')->nullable()->after('nama_lengkap');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('tanggal_lahir');
            $table->string('agama')->nullable()->after('jenis_kelamin');

            // Uploads
            $table->string('foto')->nullable()->after('status');
            $table->string('kartu_keluarga')->nullable()->after('foto');
            $table->string('akte_kelahiran')->nullable()->after('kartu_keluarga');
            $table->string('ijazah')->nullable()->after('akte_kelahiran');
            $table->string('kip')->nullable()->after('ijazah'); // Kartu Indonesia Pintar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_siswas', function (Blueprint $table) {
            $table->dropColumn([
                'nama_wali',
                'pekerjaan_wali',
                'alamat_wali',
                'penghasilan_wali',
                'tempat_lahir',
                'tanggal_lahir',
                'jenis_kelamin',
                'agama',
                'foto',
                'kartu_keluarga',
                'akte_kelahiran',
                'ijazah',
                'kip',
            ]);
        });
    }
};
