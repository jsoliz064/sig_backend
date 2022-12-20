<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'contact','photo','plate','seats','bus_id','car_model_id',
    ];

    public function bus()
    {
        return  $this->belongsTo('App\Bus');
    }
    public function model()
    {
        return  $this->belongsTo('App\CarModel','car_model_id');
    }

    public function drivers()
    {
        return  $this->hasMany('App\Driver');
    }
}
