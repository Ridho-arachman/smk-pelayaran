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
            $table->string('registration_number')->unique();
            $table->string('nisn', 10)->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->enum('gender', ['male', 'female']);
            $table->string('previous_school');
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->text('address');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->json('documents')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb');
    }
};
