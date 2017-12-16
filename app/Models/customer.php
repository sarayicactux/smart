<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    public function url()
    {
        return $this->belongsTo('App\Models\url');
    }
    public function orders()
    {
        return $this->hasMany('App\Models\order');
    }
    public function transacts()
    {
        return $this->hasMany('App\Models\transact');
    }
}
