<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE pembayarans MODIFY COLUMN metode_pembayaran ENUM('transfer_bank', 'qris', 'tunai') NOT NULL DEFAULT 'transfer_bank'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pembayarans MODIFY COLUMN metode_pembayaran ENUM('transfer_bank', 'e_wallet', 'kartu_kredit', 'tunai') NOT NULL DEFAULT 'transfer_bank'");
    }
};