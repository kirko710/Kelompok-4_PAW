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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_lapangan')->constrained('lapangans')->onDelete('cascade');
            $table->date('tanggal_pesan');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->decimal('total_harga', 10, 2);
            $table->enum('status_pesanan', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
            
            // Index untuk query yang sering dilakukan
            $table->index('id_user');
            $table->index('id_lapangan');
            $table->index('tanggal_pesan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
