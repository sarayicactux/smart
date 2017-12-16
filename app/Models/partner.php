<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class partner extends Model
{
    public function urls()
    {
        return $this->hasMany('App\Models\url');
    }
    public function payrqs()
    {
        return $this->hasMany('App\Models\payrq');
    }
    public function payparts()
    {
        return $this->hasMany('App\Models\paypart');
    }
}
