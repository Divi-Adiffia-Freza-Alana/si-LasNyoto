<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BahanBaku_Produk_Detail extends Pivot
{
    use HasFactory;

    protected $table = 'bahanbaku_produk_detail';
    
    protected $fillable = ['id','id_produk','id_bahan_baku','qty'];

    public function getIncrementing(){
        return false;
    }
    public function getKeyType(){
        return 'string';
    }

    public function bahanbaku()
{
    return $this->belongsTo(Bahanbaku::class,'id_bahan_baku', 'id');
}
    public function produk()
    {
        return $this->belongsTo(Produk::class,'id_produk', 'id');
    }





}
