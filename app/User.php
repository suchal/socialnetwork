<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','profile_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->belongsTo(profile::class);
    }

    public function status()
    {
        return $this->hasMany(status::class);
    }

    public function comments()
    {
        return $this->hasMany(comment::class);
    }

    public function updateProfile(array $data=[])
    {
        $this->profile->update($data);
    }
}
