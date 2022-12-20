<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'inDate','outDate','taken','status','user_id','vehicle_id',
    ];

    public function user()
    {
        return  $this->belongsTo('App\User');
    }

    public function vehicle()
    {
        return  $this->belongsTo('App\Vehicle');
    }

    public function session()
    {
        return  $this->hasMany('App\Session');
    }
}
