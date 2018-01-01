<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{

    protected $fillable = ['name', 'family', 'password','tel','mobile','pro_id','city_id','url_id','addr','p_code'];
    protected $guarded = ['id','updated_at','created_at'];
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
    public function cardps()
    {
        return $this->hasMany('App\Models\cardp');
    }

}
