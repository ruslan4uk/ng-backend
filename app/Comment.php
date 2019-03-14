<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['guide_id', 'author_id', 'text'];

    // relation user table
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

    // relation user_data table
    public function user_data()
    {
        return $this->belongsTo('App\UserData', 'author_id', 'user_id')->withDefault();
    }
}
