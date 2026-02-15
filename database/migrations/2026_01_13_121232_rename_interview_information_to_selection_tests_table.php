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
        Schema::rename('interview_information', 'selection_tests');

        Schema::table('selection_tests', function (Blueprint $table) {
            $table->enum('type', ['mengaji', 'wawancara'])->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('selection_tests', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::rename('selection_tests', 'interview_information');
    }
};
