<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class printact extends Model
{
    public function printeds()
    {
        return $this->hasMany('App\Models\printed');
    }
}
