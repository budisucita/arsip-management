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
        Schema::create('dokumentasi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kegiatan_id');
            $table->uuid('users_id');
            $table->enum('tipe', ['foto', 'video']);
            $table->string('file_path');
            $table->text('deskripsi')->nullable();
            $table->timestamp('uploaded_at')->useCurrent();

            $table->foreign('kegiatan_id')->references('id')->on('kegiatan')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumentasi');
    }
};
