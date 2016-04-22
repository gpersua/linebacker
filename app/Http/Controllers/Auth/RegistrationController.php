<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace linebacker\Http\Controllers\Auth;
use Illuminate\Support\Facades\Input;
use View;
use linebacker\lb_users;
use Validator;
use linebacker\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Redirect;
use Session;
use Laracasts\Flash\Flash;
use Response;
use Crypt;
use Mail;
use DB;
class RegistrationController extends Controller {

    public function __construct()
    {
        $this->beforeFilter('guest');
    }
    /**
     * Show a form to register the user.
     *
     * @return Response
     */
    public function create()
    {
    return View::make('auth.register');
    }
        
    public function store()
    {
        $rules = [
            'name' => 'required|min:6',
            'email' => 'required|email|unique:lb_users',
            'password' => 'required|confirmed|min:6'
        ];

        $input = Input::only(
            'name',
            'email',
            'password',
            'password_confirmation'
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $confirmation_code  = array( 'confirmation_code' => str_random(32));
        
        $email=Input::get('email');
        $name=Input::get('name');

        lb_users::create([
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => bcrypt(Input::get('password')),
            'confirmation_code' => $confirmation_code['confirmation_code'],
	    'avatar' => '/img/user.png'
        ]);
        
        try{
            Mail::send('email.verify', array('confirmation_code' =>$confirmation_code), 
                function($message) use ($email, $name){
                       $message->from('no-reply@privacyprotector.org', 'Linebacker');
                       $message->to($email, $name)->subject('Verify your email address');
                       }
                );
        }catch(\Exception $e){
            
            return Redirect::back()->with('status', 'There was an error sending email');

        }
			

        return Redirect::back()->with('status', 'Thanks for signing up on LineBacker! Please check your email.');
    }
    
    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = lb_users::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->in_active = 1;
        $user->confirmation_code = null;
        $user->save();

        return Redirect::route('login_path')->with('status','You have successfully verified your account.');
    }
}
