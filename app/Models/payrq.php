<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payrq extends Model
{
    public function partner()
    {
        return $this->belongsTo('App\Models\partner');
    }
    public function paypart()
    {
        return $this->hasOne('App\Models\paypart');
    }
}
