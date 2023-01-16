<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auto_number extends Model
{    
    protected $table = 'm_auto_number';
    protected $guarded = [];
    public $timestamps = false;

    public static function nomor($subject, $year = false)
    {
        $q = Auto_number::select('id', 'increment_number as nomor')
                ->whereYear('current_year', $year)
                ->where('subject', $subject)
                ->first();

        $nomor = ($q ? (int) $q->nomor + 1 : 1);
        
		return str_pad($nomor, 4, '0', STR_PAD_LEFT);
    }

    public static function nomor_save($subject, $year = false)
    {
        $q = Auto_number::select('id', 'increment_number as nomor')
                ->where('subject', $subject)
                ->where(function($q)use($year){
                    if($year) $q->whereYear('current_year', $year);
                })
                ->first();

        if($q){
            $nomor = str_pad((int) $q->nomor + 1, 4, '0', STR_PAD_LEFT);
            $q->update(['increment_number' => $nomor]);
        }else{
            Auto_number::create([
                    'current_year' => date('Y-m-d'),
                    'subject' => $subject,
                    'increment_number' => '0001'
            ]);
            $nomor = '0001';
        }

		return $nomor;
    }

    public static function nomor_saveDigit($subject)
    {
        $q = Auto_number::select('id', 'increment_number as nomor')
                ->where('subject', $subject)
                ->first();

        if($q){
            $nomor = str_pad((int) $q->nomor + 1, 8, '0', STR_PAD_LEFT);
            $q->update(['increment_number' => $nomor]);
        }else{
            $q = Auto_number::create([
                    'current_year' => date('Y-m-d'),
                    'subject' => $subject,
                    'increment_number' => '00000001'
            ]);
            $nomor = '00000001';
        }

		return $nomor;
    }
}
