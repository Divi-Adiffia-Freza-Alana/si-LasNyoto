<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengiriman extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'pengiriman';
    
    protected $fillable = [
        'id',
        'id_kurir',
        'nopol',
        'kendaraan',
        'tgl_kirim',
        'alamat',
        'nama_penerima',
    ];

    public function getIncrementing(){
        return false;
    }
    public function getKeyType(){
        return 'string';
    }





    public function transaksi()
    {
        return $this->belongsTo(Transaksi::Class, 'id', 'id_pengiriman');
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
