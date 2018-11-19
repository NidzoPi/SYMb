<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use CyrildeWit\PageViewCounter\Traits\HasPageViewCounter;

class Specs extends Model
{
    use HasPageViewCounter;
    public function category ()
    {
    	return $this->belongsTo('App\Category');
    }

    public function tags ()
    {
    	return $this->belongsToMany('App\Tag');
    }
     public function images()
    {
        return $this->hasMany('App\FuckImg');
    }
 	protected $appends = ['page_views'];

    /**
     * Get the total page views of the article.
     *
     * @return int
     */
    public function getPageViewsAttribute()
    {
        return $this->getPageViews();
    }

    use Sluggable;
      /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
     public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
