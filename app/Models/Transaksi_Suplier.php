<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi_Suplier extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'transaksi_suplier';
    
    protected $fillable = [
        'id',
        'nama_toko',
        'kode',
        'tgl_transaksi',
        'total',
        'status_bayar',
    ];

    public function getIncrementing(){
        return false;
    }
    public function getKeyType(){
        return 'string';
    }

       public function suplier()
    {
        return $this->belongsTo(Suplier::Class, 'id_suplier', 'id');
    }

    public function bahanbaku()
    {
        return $this->belongsToMany(BahanBaku::class,'transaksi_suplier_detail','id_transaksi','id_bahanbaku')->withPivot(['qty','harga','subtotal']);
    }

    

    /*public function keeperfoto()
    {
        return $this->hasMany(Keeper_foto::Class, 'id_keeper', 'id');
    }*/

   /* public function pelayan()

    {
    return $this->belongsTo(Pelayan::Class, 'id', 'id_user');
    }

    public function bagdapur()

    {
    return $this->belongsTo(Bag_Dapur::Class, 'id', 'id_user');
    }*/
  
}
