<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BahanBaku extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'bahan_baku';
    
    protected $fillable = ['id','nama','stok','satuan'];

    public function getIncrementing(){
        return false;
    }
    public function getKeyType(){
        return 'string';
    }

    public function produk()
    {
        return $this->belongsToMany(Produk::Class, 'bahanbaku_produk_detail','id_produk','id_bahan_baku')->withPivot('qty');
    }
    public function transaksi()
    {
        return $this->belongsToMany(Transaksi_Suplier::Class, 'transaksi_suplier_detail','id_transaksi','id_bahan_baku')->withPivot(['qty','harga','subtotal']);
    }


    








}
