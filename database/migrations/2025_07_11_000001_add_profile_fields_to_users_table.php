<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->text('address')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('address');
            $table->string('profession')->nullable()->after('bio');
            $table->date('date_of_birth')->nullable()->after('profession');
            $table->string('gender')->nullable()->after('date_of_birth');
            $table->string('website')->nullable()->after('gender');
            $table->json('skills')->nullable()->after('website');
            $table->string('photo')->nullable()->after('skills');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'address', 'bio', 'profession',
                'date_of_birth', 'gender', 'website', 'skills', 'photo',
            ]);
        });
    }
};
