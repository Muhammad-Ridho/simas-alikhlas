<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model {
    use HasFactory;

    protected $table = 'reports';
    protected $fillable = ["asset_id", "tanggal_laporan", "nilai_perolehan", "umur_aset", "penyusutan_per_bulan", "penyusutan_per_tahun", "nilai_saat_ini", "keterangan"];

    protected $casts = [
		'tanggal_laporan' => 'datetime'
	];

    public function asset() {
		return $this->belongsTo(Asset::class);
	}
}
