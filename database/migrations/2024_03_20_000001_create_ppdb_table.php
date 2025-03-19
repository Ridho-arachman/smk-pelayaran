<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppdb', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('full_name');
            $table->string('nisn')->unique();
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('previous_school');
            $table->enum('major', ['nautika', 'teknika', 'manajemen']);
            $table->string('photo');
            $table->string('certificate');
            $table->enum('status', ['pending', 'verified', 'accepted', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb');
    }
};
