<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'menu';
    
    protected $fillable = ['id','kd_menu','nama','jenis','komposisi','deskripsi','foto','foto_url','harga','status'];

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
    public function bahanbaku(){
        return $this->belongsTo(BahanBaku::Class, 'id_bahanbaku', 'id');
    }
}

