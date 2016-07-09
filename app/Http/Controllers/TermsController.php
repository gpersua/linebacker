<?php
namespace linebacker\Http\Controllers;
use View;
use Auth;
use Redirect;
use linebacker\lb_account;
use DB;
use Session;
use Input;
use linebacker\Http\Controllers\Controller;

class PagesController extends Controller {
	/**
	* Create a new password controller instance.
	*
	* @return void
	*/

    public function home()
    {
        // $confirmed = DB::table('lb_users')->where('email', Input::get('email'))->value('confirmed');
         //var_dump($confirmed);
	if (Auth::check() && Auth::user()->confirmed && Auth::user()->in_active){
               /* if($account = DB::table('lb_account')->where('id', Auth::User()->id)->value('userAcc'))
                {
                    Session::put('userAcc', $account);
                    Session::get('skin', 'skin-blue');
                }*/
		return View::make('home');
	}
        Auth::logout();
        Session::flush();
        return View::make('auth/login');
    }
    
    public function terms()
    {
        return View::make('terms'); 
    }
     public function privacy()
    {
        return View::make('privacy'); 
    }
    public function theme(){
    $theme = Input::get('theme');
    Session::put('skin', $theme);
    return redirect('/home');
    }
}
