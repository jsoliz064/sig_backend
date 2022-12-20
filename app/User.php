<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin', 'birthday', 'ci','email','gender','name','phone','license_category_id','password','bus_id',
    ];

    public function license()
    {
        return  $this->belongsTo('App\LicenseCategory','license_category_id');
    }

    public function bus()
    {
        return  $this->belongsTo('App\Bus','bus_id');
    }

    public function drivers()
    {
        return  $this->hasMany('App\Driver');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
