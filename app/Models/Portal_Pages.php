<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portal_Pages extends Model
{    
    protected $table = '_portal_pages';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
}
