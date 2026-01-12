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
            $table->string('no_pendaftaran')->nullable()->after('user_id')->unique();

            // Make existing fields nullable for initial registration
            $table->string('tempat_lahir')->nullable()->change();
            $table->date('tanggal_lahir')->nullable()->change();
            $table->string('jenis_kelamin')->nullable()->change();
            $table->string('agama')->nullable()->change();
            $table->string('nisn')->nullable()->change();
            $table->string('asal_sekolah')->nullable()->change();
            $table->string('no_hp')->nullable()->change();
            $table->string('no_hp_orang_tua')->nullable()->change();
            $table->text('alamat')->nullable()->change();
            $table->string('nama_wali')->nullable()->change();
            $table->string('pekerjaan_wali')->nullable()->change();
            $table->string('alamat_wali')->nullable()->change();
            $table->string('penghasilan_wali')->nullable()->change();
            $table->string('jurusan_pilihan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_siswas', function (Blueprint $table) {
            $table->dropColumn('no_pendaftaran');

            // Revert fields to NOT NULL if possible, but change() is better here
            $table->string('tempat_lahir')->nullable(false)->change();
            $table->date('tanggal_lahir')->nullable(false)->change();
            $table->string('jenis_kelamin')->nullable(false)->change();
            $table->string('agama')->nullable(false)->change();
            $table->string('nisn')->nullable(false)->change();
            $table->string('asal_sekolah')->nullable(false)->change();
            $table->string('no_hp')->nullable(false)->change();
            $table->string('no_hp_orang_tua')->nullable(false)->change();
            $table->text('alamat')->nullable(false)->change();
            $table->string('nama_wali')->nullable(false)->change();
            $table->string('pekerjaan_wali')->nullable(false)->change();
            $table->string('alamat_wali')->nullable(false)->change();
            $table->string('penghasilan_wali')->nullable(false)->change();
            $table->string('jurusan_pilihan')->nullable(false)->change();
        });
    }
};
