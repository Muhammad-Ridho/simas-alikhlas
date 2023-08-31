<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model {
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = ["asset_id", "tgl_transaksi", "jns_transaksi", "nilai_transaksi", "keterangan"];

    protected $casts = [
		'tgl_transaksi' => 'datetime'
	];

    public function asset() {
		return $this->belongsTo(Asset::class);
	}
}
