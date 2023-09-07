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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id'); 
            $table->date('tgl_transaksi'); 
            $table->enum('jns_transaksi', ['perbaikan', 'pemeliharaan', 'penambahan nilai aset']);
            $table->decimal('nilai_transaksi', 10, 2); 
            $table->text('keterangan'); 
            $table->timestamps();

            $table->foreign('asset_id')->references('id')->on('assets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
