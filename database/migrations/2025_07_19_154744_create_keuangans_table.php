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
        Schema::create('keuangan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kegiatan_id');
            $table->uuid('users_id');
            $table->enum('jenis_transaksi', ['pemasukan', 'pengeluaran']);
            $table->decimal('jumlah', 12, 2);
            $table->text('keterangan');
            $table->string('bukti_file', 255)->nullable();
            $table->date('tanggal');
            $table->string('lpj_file', 255)->nullable();

            $table->foreign('kegiatan_id')->references('id')->on('kegiatan')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan');
    }
};
