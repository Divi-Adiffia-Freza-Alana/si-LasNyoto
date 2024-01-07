<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'transaksi';  
    
    protected $fillable = ['id','id_konsumen','id_pelayan','id_bag_dapur','id_meja','kode','tgl_transaksi','total','status','no_meja', 'status_bayar'];

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

    public function menu()
    {
        return $this->belongsToMany(Menu::class,'transaksi_detail','id_transaksi','id_menu')->withPivot('qty');
    }

    public function bagdapur()
    {
        return $this->hasOne(Users::Class, 'id', 'id_bag_dapur');
    }

    public function meja()
    {
        return $this->hasOne(Meja::Class, 'id', 'id_meja');
    }

    public function konsumen()
    
        {
        return $this->hasOne(Users::Class, 'id', 'id_konsumen');
        }

    public function pelayan()

    {
    return $this->hasOne(Users::Class, 'id', 'id_pelayan');
    }


}
