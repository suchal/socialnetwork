<?php

namespace App\Policies;

use App\FriendOffer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FriendOfferPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function sendFriendOffer(User $user, User $receiver){
        if($user->id == $receiver->id) return false;
        if($user->hasSentFriendOffer($receiver)) return false;
        if($user->hasReceivedFriendOffer($receiver)) return false;
        if($user->isFriend($receiver)) return false;
        return true;
    }

    public function acceptFriendOffer(User $user, FriendOffer $offer){
       if($offer->receiver->id == $user->id) return true;
    }


}
