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
       Schema::create('table_transaksi', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        $table->foreignId('id_pelanggan')
              ->constrained('table_pelanggan')
              ->cascadeOnDelete();

        $table->foreignId('id_barang')
              ->constrained('table_barang')
              ->cascadeOnDelete();

        $table->date('tanggal');
        $table->integer('total_harga');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
