<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cardp extends Model
{
    public function url()
    {
        return $this->belongsTo('App\Models\url');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\customer');
    }
    public function order()
    {
        return $this->belongsTo('App\Models\order');
    }
}
