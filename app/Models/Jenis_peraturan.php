<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis_peraturan extends Model
{    
    protected $table = 'm_jenis_peraturan';
    protected $primaryKey = 'id_jenis';
    protected $guarded = [];
    public $timestamps = false;
}
