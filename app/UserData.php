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
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }
}
