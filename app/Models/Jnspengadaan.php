<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jnspengadaan extends Model {
    use HasFactory;

    protected $table = 'jnspengadaans';
    protected $fillable = ["name"];

}
