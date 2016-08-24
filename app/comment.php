<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable = ['body','status_id','user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function status()
    {
    	return $this->belongsTo(status::class);
    }
}
