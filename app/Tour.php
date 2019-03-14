<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'user_id'
    ];

    /**
     * Relation tour->user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }


    /**
     * Relation tour->user_data
     *
     * @return void
     */
    public function user_data() 
    {
        return $this->belongsTo('App\UserData', 'user_id', 'user_id')->withDefault();
    }

}
