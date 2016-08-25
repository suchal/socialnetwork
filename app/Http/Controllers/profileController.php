<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\profile;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class profileController extends Controller
{
	private $auth;

	public function __construct(Auth $auth){
		$this->middleware('auth');
		
		$this->auth = $auth;
	}
    public function index()
    {
        $user = $this->auth->user();
        return $this->viewProfile($user);
    }
	public function show($name, Request $req)
	{
		$vuser;
		try{
			$vuser = User::whereUsername($name)->first();
			if($vuser==null) throw new \Exception("user not found");
		}
		catch(Exception $e){
			var_dump($e);
		}
		return $this->viewProfile($vuser);
	}
	private function viewProfile($user)
	{
		$user->load(['profile','status.comments.user.profile']);
        $statuses = $user->status;
        return view('home',['statuses'=>$statuses, 'user'=> $user]);
	}

	public function edit()
	{
		$user = $this->auth->user();
		$args=[];
		$args['user'] = $user;
		$args['fullname'] = $user->profile->fullname;

		if($user->profile->dob != null){
			$bday = new \DateTime($user->profile->dob);
			$args['month']=$bday->format('m');
			$args['date'] = $bday->format('d');
			$args['year'] = $bday->format('Y');
		}
		//return $args;
		return view('edit', $args );
	}
     
    public function validateDate($data) 
    {
        return checkdate($data['month'],$data['date'],$data['year']);
    }

	public function update(Request $req)
	{
		if(Gate::allows('update',$profile));
		$rules = [
			'fullname' => ['required', 'min:3'],
			'date' 	   => ['required','numeric','min:1','max:31'],
			'month'    => ['required','numeric','min:1','max:12'],
			'year' 	   => ['required','numeric','min:1900',"max:2016"]
		];
		$this->validate($req,$rules);
			if (!$this->validateDate($req->all()) ) 
				return redirect('profile/edit')->withErrors(["date"=>"Enter a valid date!"])->withInput($req->all());
			$data=[];
			$data['dob']= "{$req->year}-{$req->month}-{$req->date}";
			$data['fullname']=$req->fullname;
			$data['age']= ( new \DateTime($data['dob']) )->diff( new \DateTime('now') )->y;
			$profile = $this->auth->user()->profile;
			$profile->update($data);
			//return [$data,$profile];	
			return back();// redirect()->route('home');

	}
	
	
}
