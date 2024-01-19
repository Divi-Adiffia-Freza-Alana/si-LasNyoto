<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'produk';
    
    protected $fillable = ['id','kode_produk','nama','jenis','deskripsi','foto','foto_url','harga', 'status'];

    public function getIncrementing(){
        return false;
    }
    public function getKeyType(){
        return 'string';
    }

    public function bahanbaku()
    {
        return $this->belongsToMany(BahanBaku::Class, 'bahanbaku_produk_detail', 'id_produk', 'id_bahan_baku')->withPivot('id_produk','qty');
     //   return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }
    

    

}
