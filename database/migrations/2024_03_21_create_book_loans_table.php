<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // For physical books
        Schema::create('book_loans', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUlid('library_id')->constrained()->cascadeOnDelete();
            $table->timestamp('borrowed_at');
            $table->timestamp('due_date');
            $table->timestamp('returned_at')->nullable();
            $table->enum('status', ['borrowed', 'returned', 'overdue'])->default('borrowed');
            $table->timestamps();
            $table->softDeletes();
        });

        // For digital books access tracking
        Schema::create('book_access_logs', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUlid('library_id')->constrained()->cascadeOnDelete();
            $table->timestamp('accessed_at');
            $table->enum('action', ['view', 'download']);
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });

        // For managing digital access rights
        Schema::create('user_libraries', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('user_id');
            $table->string('library_id', 26);
            $table->timestamp('last_accessed_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('library_id')->references('id')->on('libraries')->onDelete('cascade');
            $table->unique(['user_id', 'library_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_libraries');
        Schema::dropIfExists('book_access_logs');
        Schema::dropIfExists('book_loans');
    }
};
