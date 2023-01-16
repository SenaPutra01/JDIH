<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portal_Berita extends Model
{    
    protected $table = 'm_news';
    protected $primaryKey = 'id_news';
    protected $guarded = [];
    public $timestamps = false;
}
