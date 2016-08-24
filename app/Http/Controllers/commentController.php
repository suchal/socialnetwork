<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Contracts\Auth\Factory as Auth;
use \App\status;
use \App\comment;
class commentController extends Controller
{
	protected $rules = ['body'=>'required','status_id'=>'required|numeric'];
	protected $auth;
    public function __construct(Auth $auth)
    {
    	$this->auth = $auth;
    	$this->middleware('auth');
    }

    public function create(Request $req)
    {
    	$this->validate($req,$this->rules);
    	$user = $this->auth->user();
    	$status = status::find($req->status_id);
    	$comment = new comment($req->all());
    	$comment->user()->associate($user);
    	$status->comments()->save($comment);
    	return back();
    }
    public function edit(comment $comment){
        $user = $this->auth->user();
        return view("comment.edit",compact('user','comment'));
    }
    public function update(Request $req, comment $comment){
        $rules = ['body'=>['required','min:3','max:200']];
        $this->validate($req,$rules);
        $comment->update(["body"=>$req->body]);
        return redirect()->route('home');
    }
    public function deleteShow(comment $comment){
        return view("comment.delete",compact('comment'));
    }
    public function delete(Request $req, comment $comment){
        $comment->delete();
        return redirect()->route('home');
    }
}
