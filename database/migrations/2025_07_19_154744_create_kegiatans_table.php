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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('users_id');
            $table->string('nama_kegiatan', 100);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('deskripsi');
            $table->string('proposal_file')->nullable();
            $table->string('rab_file')->nullable();
            $table->string('lpj_file')->nullable();
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
