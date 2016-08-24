<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory as Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $auth;
    protected $user;
    public function __construct(Auth $auth)
    {
        $this->middleware('auth');
        $this->auth = $auth;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->auth->user();
        $user->load(['profile','status.comments.user.profile']);
        //return $user;
        $statuses = $user->status;
        $statuses;
        return view('home',['statuses'=>$statuses, 'user'=> $user]);
    }


}
