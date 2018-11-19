<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function posts ()
    {
    	return $this->hasMany('App\Post');
    }
    public function specs ()
    {
    	return $this->hasMany('App\Specs');
    }
}
