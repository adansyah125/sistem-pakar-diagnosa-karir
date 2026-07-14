<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('diagnosis_results', function (Blueprint $table) {
            $table->json('cf_results')->nullable()->after('conclusion');
        });
    }

    public function down(): void
    {
        Schema::table('diagnosis_results', function (Blueprint $table) {
            $table->dropColumn('cf_results');
        });
    }
};
