<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $fillable = [
        'model','status',
    ];
    public function vehicles()
    {
        return  $this->hasMany('App\Vehicle','car_model_id');
    }
}
