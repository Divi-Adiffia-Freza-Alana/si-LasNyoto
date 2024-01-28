<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Metode_Pembayaran  extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'metode_pembayaran';
    
    protected $fillable = [
        'id',
        'no_rek',
        'jenis'
    ];

    public function getIncrementing(){
        return false;
    }
    public function getKeyType(){
        return 'string';
    }





    public function transaksi()
    {
        return $this->belongsTo(Transaksi::Class, 'id_metode_pembayaran', 'id');
    }

  
}
