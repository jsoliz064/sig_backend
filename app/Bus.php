<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'color', 'name', 'photo','status',
    ];

    public function coordinates()
    {
        return  $this->hasMany('App\Coordinate');
    }

    public function vehicles()
    {
        return  $this->hasMany('App\Vehicle');
    }

    public function users()
    {
        return  $this->hasMany('App\User');
    }

}
