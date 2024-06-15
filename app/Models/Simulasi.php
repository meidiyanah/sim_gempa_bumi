<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simulasi extends Model
{
    protected $table = "simulasi";
    protected $fillable = ["id", "id_user", "nama", "koorx", "koory", "kedalaman", "ukuran"];
}
