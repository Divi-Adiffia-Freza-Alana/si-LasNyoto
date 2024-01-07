<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi_Suplier_Detail extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'transaksi_suplier_detail';
    
    protected $fillable = [
        'id',
        'id_transaksi',
        'id_bahanbaku',
        'qty',
        'harga',
        'subtotal'
    ];

    public function getIncrementing(){
        return false;
    }
    public function getKeyType(){
        return 'string';
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi_Suplier::class,'id_transaksi', 'id');
    }

    public function bahanbaku()
    {
        return $this->belongsTo(BahanBaku::class,'id_bahanbaku', 'id');
    }

    


  
}
