<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class paypart extends Model
{
    public function partner()
    {
        return $this->belongsTo('App\Models\partner');
    }
    public function payrq()
    {
        return $this->belongsTo('App\Models\payrq');
    }
}
