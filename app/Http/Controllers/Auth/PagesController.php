<?php
namespace linebacker\Http\Controllers\Auth;
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
	if (Auth::check() && Auth::User()->confirmed){
               /* if($account = DB::table('lb_account')->where('id', Auth::User()->id)->value('userAcc'))
                {
                    Session::put('userAcc', $account);
                    Session::get('skin', 'skin-blue');
                }*/
		return View::make('home');
	}
        return View::make('welcome');
    }
    
    public function welcome()
    {
        return View::make('welcome');
        //return redirect('/wordpress');
    }
    
    public function theme(){
    $theme = Input::get('theme');
    Session::put('skin', $theme);
    return redirect('/home');
    }
}
