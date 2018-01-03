<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payrq extends Model
{
    protected $fillable = ['amount', 'description', 'partner_id'];
    protected $guarded = ['id','updated_at','created_at'];
    public function partner()
    {
        return $this->belongsTo('App\Models\partner');
    }
    public function paypart()
    {
        return $this->hasOne('App\Models\paypart');
    }
}
