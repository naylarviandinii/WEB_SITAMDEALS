<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Kita daftarkan 'diambil_dibayar' ke dalam list ENUM
            $table->enum('status', ['pending', 'diproses', 'diterima', 'selesai', 'ditolak', 'diambil_dibayar'])
                  ->default('pending')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Kembalikan ke struktur semula jika di-rollback
            $table->enum('status', ['pending', 'diproses', 'diterima', 'selesai', 'ditolak'])
                  ->default('pending')
                  ->change();
        });
    }
};