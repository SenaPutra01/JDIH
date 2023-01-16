<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload_file extends Model
{    
    protected $table = 'uploaded_file';
    protected $primaryKey = 'id_file';
    protected $guarded = [];
}
