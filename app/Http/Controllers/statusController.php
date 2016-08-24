<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \App\User;
use \App\status;

class statusController extends Controller
{
	protected $auth;
	protected $rules = ['text'=>'required|max:100'];
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


    public function show(Status $status){
    	try{
    		if(!$status)
    			throw new NotFoundHttpException("Not found!");
    	}
    	catch(NotFoundHttpException $e){
    		return $e->getMessage();
    	}
    	$auth = $this->auth;
    	$status->load(['user','comments.user']);
    	return view('status.show',compact('auth','status'));
    }


    public function edit(status $status){
    	//return $status;
    	return view('status.edit',compact('status'));
    }
    public function update(Request $req, status $status){

    	$this->validate($req,$this->rules);
        $status->update(['text'=>$req->text]);
    	return back();
    }

    public function showDelete(Status $status){
    	try{
    		if(!$status) throw new Exception("Not Found");
    	}
    	catch(Exception $e){
    		return $e->getMessage();
    	}

    	return view("status.delete",["status"=>$status]);
    	
    }

    public function delete(status $status){
    	$status->delete();
    }
}
