<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'date', 'message', 'isLogin','user_id','vehicle_id','driver_id'
    ];

    public function drivers()
    {
        return  $this->belongsTo('App\Driver');
    }
}
