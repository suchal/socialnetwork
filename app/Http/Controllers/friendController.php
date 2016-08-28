<?php

namespace App\Http\Controllers;

use App\Friend;
use App\FriendOffer;
use App\Http\Requests;
use App\User;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class friendController extends Controller
{
	private $auth;

	public function __construct(Auth $auth)
	{
		$this->auth = $auth;
	}

    public function sendOffer(User $user){
    	//first check if we can send the offer in the first place
    	$friendOffer = new FriendOffer;
    	$friendOffer->sender()->associate($this->auth->user());
    	$friendOffer->receiver()->associate($user);
    	$friendOffer->save();
    	return back();
    }

    public function acceptOffer(FriendOffer $offer){
    	//checking if the offer is actually for the user
    	//
    	$receiver_id = $this->auth->user()->id;
    	$sender_id = $offer->sender->id;
    	Friend::create(['first'=>$sender_id,'second'=>$receiver_id]);
    	Friend::create(['first'=>$receiver_id,'second'=>$sender_id]);
    	
    	// $friendship = new Friend();
    	// $friendship->first()->associate($sender);
    	// $friendship->second()->associate($receiver);
    	// $friendship->save();
    	// $friendship = new Friend();
    	// $friendship->first()->associate($receiver);
    	// $friendship->second()->associate($sender);
    	// $friendship->save();
    	
    	$offer->delete();
    	return back();
    }
}
