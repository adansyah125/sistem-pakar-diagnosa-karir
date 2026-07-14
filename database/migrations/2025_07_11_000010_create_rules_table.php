<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('diagnosis_questions')->cascadeOnDelete();
            $table->foreignId('career_id')->constrained('careers')->cascadeOnDelete();
            $table->unsignedTinyInteger('min_score');
            $table->decimal('cf', 3, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
