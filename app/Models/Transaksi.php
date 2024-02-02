<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'transaksi';  
    
    //protected $fillable = ['id', 'kode', 'id_konsumen','id_kurir','id_marketing', 'id_metode_pembayaran', 'id_sph','tgl_transaksi', 'nama','no_hp','alamat', 'total','jenispembayaran','statusorder'];
    protected $fillable = ['id', 'kode', 'id_konsumen','id_kurir','id_marketing', 'id_metode_pembayaran', 'id_sph','tgl_transaksi','alamat', 'total','jenispembayaran','statusorder','nopol','kendaraan','tgl_kirim'];

    public function getIncrementing(){
        return false;
    }
    public function getKeyType(){
        return 'string';
    }

    /*public function keeperfoto()
    {
        return $this->hasMany(Keeper_foto::Class, 'id_keeper', 'id');
    }*/

    public function produk()
    {
        return $this->belongsToMany(Produk::class,'transaksi_detail','id_transaksi','id_produk')->withPivot(['id','qty','harga']);
    }

    public function konsumen()
    
    {
    return $this->hasOne(Users::Class, 'id', 'id_konsumen');
    }

    public function kurir()
    {
        return $this->hasOne(Users::Class, 'id', 'id_kurir');
    }

    
    public function marketing()
    {
        return $this->hasOne(Users::Class, 'id', 'id_marketing');
    }

    public function sph()
    {
        return $this->hasOne(Sph::Class, 'id', 'id_sph');
    }

    public function metodepembayaran()
    {
        return $this->hasOne(Metode_Pembayaran::Class, 'id', 'id_metode_pembayaran');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::Class, 'id_transaksi', 'id');
    }

  


    /*public function bagdapur()
    {
        return $this->hasOne(Users::Class, 'id', 'id_bag_dapur');
    }

    public function meja()
    {
        return $this->hasOne(Meja::Class, 'id', 'id_meja');
    }

 
    public function pelayan()

    {
    return $this->hasOne(Users::Class, 'id', 'id_pelayan');
    }*/


}
