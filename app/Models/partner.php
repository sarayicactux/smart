<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class partner extends Model
{
    protected $fillable = ['name', 'family', 'email', 'password','tel','mobile','pro_id','city_id','n_code','card_num'];
    protected $guarded = ['id','updated_at','created_at'];
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
    public function visits()
    {
        return $this->hasManyThrough(
            'App\Models\visit', 'App\Models\url',
            'partner_id', 'url_id', 'id'
        );
    }
    public function customers()
    {
        return $this->hasManyThrough(
            'App\Models\customer', 'App\Models\url',
            'partner_id', 'url_id', 'id'
        );
    }
    public function orders()
    {
        return $this->hasManyThrough(
            'App\Models\order', 'App\Models\url',
            'partner_id', 'url_id', 'id'
        );
    }
    public function transacts()
    {
        return $this->hasManyThrough(
            'App\Models\transact', 'App\Models\url',
            'partner_id', 'url_id', 'id'
        );
    }
    public function cardps()
    {
        return $this->hasManyThrough(
            'App\Models\cardp', 'App\Models\url',
            'partner_id', 'url_id', 'id'
        );
    }
}

