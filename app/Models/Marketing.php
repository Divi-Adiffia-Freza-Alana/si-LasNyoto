<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marketing extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'marketing';
    
    protected $fillable = ['id','id_user','no_hp','jk'];

    public function getIncrementing(){
        return false;
    }
    public function getKeyType(){
        return 'string';
        
    }

    public function user()
    {
        return $this->hasOne(Users::Class, 'id', 'id_user');
    }

    /*public function keeperfoto()
    {
        return $this->hasMany(Keeper_foto::Class, 'id_keeper', 'id');
    }*/
}
