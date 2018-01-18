<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class printed extends Model
{
    public function order()
    {
        return $this->hasOne('App\Models\order');
    }
    public function printact()
    {
        return $this->belongsTo('App\Models\printact');
    }
}
