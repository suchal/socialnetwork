<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    protected $table = "status";
    protected $fillable = ['text'];

    public function user()
    {
    	return $this->hasOne(User::class);
    }

    public function comments()
    {
    	return $this->hasMany(comment::class);
    }
}
