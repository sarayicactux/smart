<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cardp extends Model
{
    protected $fillable = ['pay_time', 'pay_date','amount','addr','tran_id','customer_id','order_id','url_id'];
    protected $guarded = ['id','updated_at','created_at'];
    public function url()
    {
        return $this->belongsTo('App\Models\url');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\customer');
    }
    public function order()
    {
        return $this->belongsTo('App\Models\order');
    }
}
