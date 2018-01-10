<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class authority extends Model
{
    protected $table = "authorities";
    protected $fillable = [ 'authority','amount','customer_id','order_id'];
    protected $guarded = ['id','updated_at','created_at'];
    public function customer()
    {
        return $this->belongsTo('App\Models\customer');
    }
    public function order()
    {
        return $this->belongsTo('App\Models\order');
    }
}
