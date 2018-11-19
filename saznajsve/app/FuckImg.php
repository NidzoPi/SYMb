<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuckImg extends Model
{
     protected $guarded=[];

    public function post()
    {
    	return $this->belongsTo('App\Post');
    }
}
