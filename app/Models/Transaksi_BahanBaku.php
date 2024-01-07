<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi_BahanBaku extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'transaction_bahanbaku';
    
    protected $fillable = ['id','id_bahanbaku','stok_awal','stok_terpakai','sisa'];

    public function getIncrementing(){
        return false;
    }
    public function getKeyType(){
        return 'string';
    }

    public function bahanbaku()
    {
        return $this->belongsTo(BahanBaku::Class, 'id_bahanbaku', 'id');
    }
}
