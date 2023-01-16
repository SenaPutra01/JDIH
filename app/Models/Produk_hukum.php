<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk_hukum extends Model
{    
    protected $table = 'jndih_produk_hukum';
    protected $primaryKey = 'id_produk_hukum';
    protected $guarded = [];

    public function jenis_peraturan()
    {
        return $this->belongsTo(Jenis_peraturan::class, 'id_jenis');
    }

    public function jenis_peraturan_sub()
    {
        return $this->belongsTo(Jenis_peraturan_sub::class, 'id_jenis');
    }

    public function upload_files()
    {
        return $this->hasMany(Upload_file::class, 'id_produk_hukum');
    }

    public static function status()
    {
        return [
            1 => 'Pengajuan',
            2 => 'Diproses',
            3 => 'Proses Autentifikasi',
            4 => 'Selesai'
        ];
    }

}
