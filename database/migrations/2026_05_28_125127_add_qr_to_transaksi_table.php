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
        Schema::table('table_transaksi', function (Blueprint $table) {
            $table->string('kode_pesanan')->nullable();
            $table->string('status')->default('Menunggu Scan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_transaksi', function (Blueprint $table) {
              $table->dropColumn('kode_pesanan');
                $table->dropColumn('status');
        });
    }
};
