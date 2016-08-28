<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class FriendOffer extends Model
{
    protected $fillable = ['sender_id','receiver_id'];

    public function sender(){
    	return $this->belongsTo(User::class, 'sender_id');    	
    }

    public function receiver(){
    	return $this->belongsTo(User::class, 'receiver_id');    	
    }
    
}
