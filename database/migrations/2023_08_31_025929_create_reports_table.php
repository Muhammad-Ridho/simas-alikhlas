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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id'); 
            $table->date('tanggal_laporan'); 
            $table->decimal('nilai_perolehan', 10, 2); 
            $table->integer('umur_aset'); 
            $table->decimal('penyusutan_per_tahun', 10, 2); 
            $table->decimal('nilai_saat_ini', 10, 2); 
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
        Schema::dropIfExists('reports');
    }
};
