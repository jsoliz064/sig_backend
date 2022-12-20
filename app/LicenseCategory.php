<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenseCategory extends Model
{
    protected $fillable = [
        'license','status'
    ];

    public function users()
    {
        return  $this->hasMany('App\User','license_category_id');
    }


}
