<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model {
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = ["name", "masa_manfaat"];

}
