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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('deskripsi');
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('jns_pengadaan_id');
            $table->date('tgl_perolehan');
            $table->decimal('nilai_perolehan', 10, 2);
            $table->unsignedBigInteger('lokasi_id');
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->boolean('is_fixed_asset');
            $table->string('asset_image_path')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategori');
            $table->foreign('jns_pengadaan_id')->references('id')->on('jnspengadaans');
            $table->foreign('lokasi_id')->references('id')->on('lokasi');
            $table->foreign('assigned_to_user_id')->references('id')->on('users');
            $table->foreign('department_id')->references('id')->on('department');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
