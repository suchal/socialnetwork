<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    protected $fillable = ['profile_picture','fullname','dob','age'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
