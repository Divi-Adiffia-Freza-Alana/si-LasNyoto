<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sph extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'sph';
    
    protected $fillable = [
        'id',
        'kode',
        'tgl',
        'deskripsi',
        'status',
    ];

    public function getIncrementing(){
        return false;
    }
    public function getKeyType(){
        return 'string';
    }





    public function transaksi()
    {
        return $this->belongsTo(Transaksi::Class, 'id_sph', 'id');
    }

   /* public function pelayan()

    {
    return $this->belongsTo(Pelayan::Class, 'id', 'id_user');
    }

    public function bagdapur()

    {
    return $this->belongsTo(Bag_Dapur::Class, 'id', 'id_user');
    }*/
  
}
