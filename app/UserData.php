<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'users_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'secondname', 'about', 'services', 'language', 'city',
        'time_to_call', 'services', 'other_contact'
    ];


    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }


    /**
     * Получить комментарии гида.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'guide_id', 'user_id');
    }

}
