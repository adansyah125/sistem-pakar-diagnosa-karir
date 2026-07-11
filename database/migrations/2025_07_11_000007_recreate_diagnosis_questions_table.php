<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('diagnosis_results');
        Schema::dropIfExists('diagnosis_questions');

        Schema::create('diagnosis_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_id')->constrained()->cascadeOnDelete();
            $table->text('question');
            $table->json('options');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('diagnosis_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('career_id')->constrained()->cascadeOnDelete();
            $table->string('education')->nullable();
            $table->text('skills')->nullable();
            $table->json('answers');
            $table->integer('total_score');
            $table->string('conclusion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnosis_results');
        Schema::dropIfExists('diagnosis_questions');
    }
};
