<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostReview extends Model
{
    protected $fillable = [
    	'headline',
    	'rating',
    	'post_id'
    ];
}
