<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class visit extends Model
{
    public function url()
    {
        return $this->belongsTo('App\Models\url');
    }
}
