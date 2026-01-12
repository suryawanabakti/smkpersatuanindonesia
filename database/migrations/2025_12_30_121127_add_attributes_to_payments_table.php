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
        Schema::table('payments', function (Blueprint $table) {
            $table->boolean('topi')->default(false)->after('description');
            $table->boolean('dasi')->default(false)->after('topi');
            $table->boolean('baju')->default(false)->after('dasi');
            $table->boolean('batik')->default(false)->after('baju');
            $table->boolean('baju_olahraga')->default(false)->after('batik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['topi', 'dasi', 'baju', 'batik', 'baju_olahraga']);
        });
    }
};
