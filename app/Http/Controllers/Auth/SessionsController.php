<?php

namespace linebacker\Http\Controllers\Auth;
use Illuminate\Support\Facades\Input;
use View;
use linebacker\lb_users;
use linebacker\lb_account;
use Validator;
use linebacker\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Redirect;
use Session;
use Laracasts\Flash\Flash;
use Response;
use Crypt;
use Mail;
use DB;

class SessionsController extends Controller {

        public function __construct()
        {
            $this->beforeFilter('guest', ['except' => ['destroy']]);
            $this->beforeFilter('auth', ['only' => ['destroy']]);
        }
 
	/**
	 * Show the login form.
	 * GET /sessions/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('auth.login');
	}

	/**
	 * Attempt to log a user in
	 * POST /sessions
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = [
            'email' => 'required|exists:lb_users',
            'password' => 'required'
        ];

        $validator = Validator::make(Input::only('email', 'password'), $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $credentials = [
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ];

  
        if(!Auth::attempt($credentials))
        {
            return Redirect::back()->withInput()->withErrors(['credentials' => 'We were unable to sign you in']);
        }else{
            $acc = DB::table('lb_account')->where('id', Auth::User()->id)->value('userAcc');

            Session::put('userAcc', $acc);
 
            return Redirect::home()->with('status','Welcome back ');
                
        }
	}
	/**
	 * Log a user out
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
	Auth::logout();
        Session::flush();
        return Redirect::home();
	}

}
