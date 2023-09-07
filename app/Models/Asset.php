<?php

namespace App\Models;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kategori;
use App\Models\Jnspengadaan;
use App\Models\Lokasi;
use App\Models\Department;

class Asset extends Model implements HasMedia
{
  use InteractsWithMedia;
  use HasFactory;

  protected $table = 'assets';
  protected $fillable = [
    "name", 
    "deskripsi", 
    "kategori_id", 
    "jns_pengadaan_id", 
    "tgl_perolehan", 
    "nilai_perolehan", 
    "lokasi_id", 
    "assigned_to_user_id", 
    "department_id", 
    "is_fixed_asset", 
    "asset_image_path
    "];

  protected $casts = [
    'tgl_perolehan' => 'datetime',
    'asset_image' => 'string',
  ];

  public function category()
  {
    return $this->belongsTo(Kategori::class, 'kategori_id');
  }

  public function jnsPengadaan()
  {
    return $this->belongsTo(Jnspengadaan::class, 'jns_pengadaan_id');
  }

  public function location()
  {
    return $this->belongsTo(Lokasi::class, 'lokasi_id');
  }

  public function department()
  {
    return $this->belongsTo(Department::class, 'department_id');
  }
}
