<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portal_Menu extends Model
{    
    protected $table = '_portal_menu';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
}
