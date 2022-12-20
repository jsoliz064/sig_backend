<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    protected $fillable = [
        'latitude', 'longitude', 'bus_id','status','coming_back',
    ];
    public function bus()
    {
        return  $this->belongsTo('App\Bus');
    }
}


//$table->float('latitude');
//$table->float('longitude');
//$table->foreignId('busId')->constrained('buses');
//$table->boolean('status')->default(true);
