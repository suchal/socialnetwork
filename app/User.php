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


    /////////////////////////***[Relationships]***/////////////////////////
    
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

    public function sentFriendOffers(){
        return $this->hasMany(FriendOffer::class, 'sender_id');
    }

    public function receivedFriendOffers(){
        return $this->hasMany(FriendOffer::class, 'receiver_id');
    }

    public function friends(){
        return $this->hasMany(Friend::class, 'first');
    }


    /////////////////////////***[helperMethods]***/////////////////////////

    public function isFriend(User $user){
        foreach($this->friends as $friendship){
            if($friendship->second == $user->id) return true;
        }
        return false;
    }

    public function hasSentFriendOffer(User $user){
        foreach($this->sentFriendOffers as $offer){
            if($offer->receiver_id == $user->id) return true;
        }
        return false;
    }

    public function hasReceivedFriendOffer(User $user){
        foreach($this->receivedFriendOffers as $offer){
            if($offer->sender_id == $user->id) return $offer;
        }
        return false;
    }

    public function updateProfile(array $data=[])
    {
        $this->profile->update($data);
    }

    public function owns($resource){
        return $resource->user_id == $this->id;
    }
}
