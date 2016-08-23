<?php

namespace linebacker\Http\Controllers\Auth;
//*******agregar esta linea******//
use linebacker\lb_users;
use Auth;
use View;
use Input;
use Redirect;
use Session;
use Response;
use Validator;
use Socialite;
use Crypt;
use Mail;
use DB;
//*******************************//
use Illuminate\Http\Request;

use linebacker\Http\Requests;
use linebacker\Http\Controllers\Controller;

class SocialController extends Controller
{
	/**
	* Create a new password controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('guest');
	}
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function facebook()
	{
		return Socialite::driver('facebook')->redirect();
	}

	/**
	* Obtain the user information from Facebook.
	*
	* @return Response
	*/
	public function facebookCallback()
	{
		try {
			$user = Socialite::driver('facebook')->user();
		} catch (Exception $e) {
			return redirect('facebook');
		}

		$authUser = $this->FbSearch($user);

		if(empty($authUser)) {
			return Redirect::back()->withErrors([
				'da_mensaje' => 'Credentials facebook account do not match our records. Try again.',
			]);
		}else{
			//Auth::login($authUser, true);
			//return redirect('/home');
			if($authUser->in_active == 0) {
				return Redirect::back()->with('status', 'Please check your email for activation.');
			} elseif($authUser->in_active == 1) {
				Auth::login($authUser, true);
				return redirect('/home');
			}
		}
	}

	/**
	* Return user if exists; create and return if doesn't
	*
	* @param $facebookUser
	* @return User
	*/
	private function FbSearch($facebookUser)
	{

	$authUser = lb_users::where('facebook_id', $facebookUser->id)->first();

	if ($authUser){
		 $user = lb_users::where('id', $authUser->id)->first();
	   	 return $user;
	}else{
	    	 $user = lb_users::where('email', $facebookUser->email)->first();

		if(empty($user)) {

        		$confirmation_code  = array( 'confirmation_code' => str_random(32));

			$user = lb_users::create([
				'name' => $facebookUser->name,
				'email' => $facebookUser->email,
				'facebook_id' => $facebookUser->id,
				'avatar' => $facebookUser->avatar,
				'confirmation_code' => $confirmation_code['confirmation_code'],
				'confirmed' => 0,
				'in_active' => 0
			]);

        		try{
				Mail::send('email.social', ['user' => $user, 'confirmation_code' => $confirmation_code], function ($message) use ($user) {
					$message->from('no-reply@privacyprotector.org', 'Linebacker'); 
					$message->to($user->email, $user->name)
					->subject('Verify your email address');
				});
			}catch(\Exception $e){
			    return Redirect::back()->with('status', 'There was an error sending email');
			}

			return $user;

		}else{
			$profile = lb_users::find($user->id);
			$profile->facebook_id= $facebookUser->id;
			$profile->save();

			return $user;
		}
	}

	}

	/**
	* Obtain the user information from Facebook.
	*
	* @return Response
	*/
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

		return View::make('auth.social')->with('user',$user)->with('confirmation_code',$confirmation_code);
	    }

	/**
	* Obtain the user information from Facebook.
	*
	* @return Response
	*/
	public function socialSave()
	{
		$validator = Validator::make(Input::all(), lb_users::$newAccount);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput(Input::except("pass"));
		}

		//$user_created = lb_users::find($id);
		$user_created = lb_users::updateOrCreate(array('confirmation_code' => Input::get('id')));
		$user_created->password = bcrypt(Input::get('password'));
		$user_created->confirmation_code = '';
		$user_created->confirmed = 1;
		$user_created->in_active = 1;
		$user_created->save();

		try{
			Mail::send('email.confirmation', ['user' => $user_created], function ($message) use ($user_created) {
				$message->from('no-reply@privacyprotector.org', 'Linebacker'); 
				$message->to($user_created->email, $user_created->name)
				->subject('Verify your email address');
			});
		}catch(\Exception $e){
		    return Redirect::back()->with('status', 'There was an error sending email');
		}

		Auth::login($user_created, true);
		return redirect('/home');
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function google()
	{
		return Socialite::driver('google')->redirect();
	}

	/**
	* Obtain the user information from Facebook.
	*
	* @return Response
	*/
	public function googleCallback()
	{
		try {
			$user = Socialite::driver('google')->user();
		} catch (Exception $e) {
			return redirect('google');
		}

		$authUser = $this->GoogleSearch($user);

		if(empty($authUser)) {
			return Redirect::back()->withErrors([
				'da_mensaje' => 'Credentials google account do not match our records. Try again.',
			]);
		}else{
			//Auth::login($authUser, true);
			//return redirect('/home');
			if($authUser->in_active == 0) {
				return Redirect::back()->with('status', 'Please check your email for activation.');
			} elseif($authUser->in_active == 1) {
				Auth::login($authUser, true);
				return redirect('/home');
			}
		}
	}

	/**
	* Return user if exists; create and return if doesn't
	*
	* @param $facebookUser
	* @return User
	*/
	private function GoogleSearch($googleUser)
	{

	$authUser = lb_users::where('google_id', $googleUser->id)->first();

	if ($authUser){
		 $user = lb_users::where('id', $authUser->id)->first();
	   	 return $user;
	}else{
	    	 $user = lb_users::where('email', $googleUser->email)->first();

		if(empty($user)) {
        		$confirmation_code  = array( 'confirmation_code' => str_random(32));
			$user = lb_users::create([
				'name' => $googleUser->name,
				'email' => $googleUser->email,
				'google_id' => $googleUser->id,
				'avatar' => $googleUser->avatar,
				'confirmation_code' => $confirmation_code['confirmation_code'],
				'confirmed' => 0,
				'in_active' => 0
			]);
        		try{
				Mail::send('email.social', ['user' => $user, 'confirmation_code' => $confirmation_code], function ($message) use ($user) {
					$message->from('no-reply@privacyprotector.org', 'Linebacker'); 
					$message->to($user->email, $user->name)
					->subject('Verify your email address');
				});
			}catch(\Exception $e){
			    return Redirect::back()->with('status', 'There was an error sending email');
			}
		    	return $user;
		}else{
			$profile = lb_users::find($user->id);
			$profile->google_id= $googleUser->id;
			$profile->save();

			return $user;
		}
	}
	}
}