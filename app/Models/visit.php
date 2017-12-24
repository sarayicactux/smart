<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class visit extends Model
{
    protected $fillable = ['url_ref', 'url_id', 'visit_time', 'visit_date'];
    protected $guarded = ['id','updated_at','created_at'];
    public function url()
    {
        return $this->belongsTo('App\Models\url');
    }
}
