<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    
    protected $guarded = ['id, user_id'];
    protected $hidden = ['user_id'];

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


    /**
     * Model reliation to usel 
     * belong to
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

}
