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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pemesanan')->constrained('pemesanans')->onDelete('cascade');
            $table->enum('metode_pembayaran', ['transfer_bank', 'e_wallet', 'kartu_kredit', 'tunai'])->default('transfer_bank');
            $table->enum('status_bayar', ['unpaid', 'pending', 'paid', 'failed', 'refunded'])->default('unpaid');
            $table->timestamp('tanggal_pembayaran')->nullable();
            $table->string('nomor_referensi')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Index untuk query yang sering dilakukan
            $table->index('id_pemesanan');
            $table->index('status_bayar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
