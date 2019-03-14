<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'login', 'role', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get User Data
     *
     * @return void
     */
    public function userdata()
    {
        return $this->hasOne('App\UserData');
    }


    public function tour() 
    {
        return $this->hasMany('App\Tour');
    }

    /**
     * Получить комментарии гида.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'guide_id', 'id');
    }

    
    /**
     * Get Article
     *
     * @return void
     */
    public function article()
    {
        return $this->hasOne('App\Article');
    }

    /**
     * Get service to User model
     *
     * @return void
     */
    public function service()
    {
        return $this->belongsToMany('App\Service');
    }

    /**
     * Undocumented function
     *
     * @param [type] $roles
     * @return void
     */
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401);
    }

    /**
     * Undocumented function
     *
     * @param [type] $roles
     * @return boolean
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check role user
     *
     * @param [type] $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if ($this->where('role', $role)->first()) {
            return true;
        }
        return false;
    }
}
