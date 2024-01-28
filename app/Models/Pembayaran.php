<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembayaran  extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'pembayaran';
    
    protected $fillable = [
        'id',
        'foto',
        'url_foto',
        'jumlah',
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
        return $this->belongsTo(Transaksi::Class, 'id_transaksi', 'id');
    }

  
}
