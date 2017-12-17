<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class url extends Model
{
    public function partner()
    {
        return $this->belongsTo('App\Models\partner');
    }
    public function visits()
    {
        return $this->hasMany('App\Models\visit');
    }
    public function customers()
    {
        return $this->hasMany('App\Models\customer');
    }
    public function orders()
    {
        return $this->hasMany('App\Models\order');
    }
    public function transacts()
    {
        return $this->hasMany('App\Models\transact');
    }
    public function cardps()
    {
        return $this->hasMany('App\Models\cardp');
    }
}
