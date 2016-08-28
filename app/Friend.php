<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
	protected $table = 'friendship';
    protected $fillable = ['first','second'];

    public function first(){
    	return $this->belongsTo(User::class, 'first', 'id');
    }
    public function second(){
    	return $this->belongsTo(User::class, 'second');
    }
    
}
