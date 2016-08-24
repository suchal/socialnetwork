<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Contracts\Auth\Factory as Auth;

use \App\User;
use \App\status;

class statusController extends Controller
{
	protected $auth;
	protected $rules = ['text'=>'required'];
	public function __construct(Auth $auth)
	{
		$this->auth = $auth;
		$this->middleware('auth');
	}
    public function create(Request $req)
    {
    	$this->validate($req, $this->rules);
    	$user = $this->auth->user();
    	$user->status()->save(status::Create($req->all()));
    	return redirect()->route('home');
    }
}
