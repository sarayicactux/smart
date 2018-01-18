<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = ['count', 'p_code','tel','addr','pro_id','customer_id','city_id','url_id'];
    protected $guarded = ['id','updated_at','created_at'];
    public function url()
    {
        return $this->belongsTo('App\Models\url');
    }
    public function authorities()
    {
        return $this->hasMany('App\Models\authority');
    }
    public function printed()
    {
        return $this->hasOne('App\Models\printed');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\customer');
    }
    public function transact()
    {
        return $this->hasOne('App\Models\transact');
    }
    public function cardp()
    {
        return $this->hasOne('App\Models\cardp');
    }
}
