<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi_detail extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'transaksi_detail';
    
    protected $fillable = ['id','id_menu','id_transaksi','qty','harga','subtotal'];

    public function getIncrementing(){
        return false;
    }
    public function getKeyType(){
        return 'string';
    }


}
