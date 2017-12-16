<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    public function url()
    {
        return $this->belongsTo('App\Models\url');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\customer');
    }
    public function transact()
    {
        return $this->hasOne('App\Models\transact');
    }
}
