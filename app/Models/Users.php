<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'users';
    
    protected $fillable = [
        'id',
        'name',
        'no_hp',
        'email',
        'password',
        'role',
    ];

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

    public function pelayan()

    {
    return $this->belongsTo(Pelayan::Class, 'id', 'id_user');
    }

    public function bagdapur()

    {
    return $this->belongsTo(Bag_Dapur::Class, 'id', 'id_user');
    }

    public function kurir()

    {
    return $this->belongsTo(Kurir::Class, 'id', 'id_user');
    }

    public function marketing()

    {
    return $this->belongsTo(Marketing::Class, 'id', 'id_user');
    }

    public function purchasing()

    {
    return $this->belongsTo(Marketing::Class, 'id', 'id_user');
    }
  
}
