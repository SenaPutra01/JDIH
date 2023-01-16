<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portal_SubMenu extends Model
{    
    protected $table = '_portal_submenu';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
}
