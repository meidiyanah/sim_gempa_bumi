<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peta extends Model
{
    protected $table = "service_peta";
    protected $fillable = ["id", "nama", "url", "layer_name", "jenis", "min_zoom", "max_zoom", "status"];
}
