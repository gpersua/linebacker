<?php

namespace linebacker\Http\Controllers;
//*******agregar esta linea******//
use linebacker\lb_users;
use Auth;
use View;
use Input;
use Redirect;
use Session;
use Response;
use Validator;
use Crypt;
use Mail;
use DB;
//*******************************//
use Illuminate\Http\Request;

use linebacker\Http\Requests;
use linebacker\Http\Controllers\Controller;

class UsersController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	$user = lb_users::select('id', 'name', 'email', 'confirmed', 'in_active', 'created_at')
	->filter($request->get('name'))
	->orderBy('id', 'ASC')
	->paginate(10);
	return View::make('users.list')->with('user',$user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	return View::make('users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id = NULL)
    {
	if($id!=''||$id!=null){
		try {
			$validator = Validator::make(Input::all(), lb_users::$edit);
			if ($validator->fails()) {
				return Redirect::back()->withErrors($validator)->withInput(Input::except("pass"));
			}

			$user = lb_users::find($id);
			$user->name = Input::get("name");
			$user->email = Input::get("email");
			$user->password = bcrypt(Input::get('password'));
                        $user->in_active = Input::get('in_active');
			$user->save();

			DB::commit();
			Session::flash('msg', 'User Updated!');
			return Redirect::to('users');
		}catch (\Exception $e)
		{
			DB::rollback();
			return Redirect::back()->withErrors([
				'msg' => array('ERROR ('.$e->getCode().'):'=> $e->getMessage())
			]);
		}
	}else{
		try {
			$validator = Validator::make(Input::all(), lb_users::$new);
			if ($validator->fails()) {
				return Redirect::back()->withErrors($validator)->withInput(Input::except("pass"));
			}

			$user = new lb_users;
			$user->name = Input::get("name");
			$user->email = Input::get("email");
			$user->password = bcrypt(Input::get('password'));
			$user->avatar = '/img/user.png';
			$user->confirmed = 1;
                        
			$user->save();

			DB::commit();
			Session::flash('msg', 'User Created!');
			return Redirect::to('users');
		}catch (\Exception $e)
		{
			DB::rollback();
			return Redirect::back()->withErrors([
				'msg' => array('ERROR ('.$e->getCode().'):'=> $e->getMessage())
			]);
		}
	}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	$users = lb_users::select( 'id', 'name', 'email', 'password', 'in_active')->where('id', '=', $id)->first();
        $user = array();
       // foreach($users as $u){
            $user['id'] = $users->id;
            $user['name'] = $users->name;
            $user['email'] =$users->email;
            $user['password'] = Crypt::decrypt($users->password);
            $user['in_active'] = $users->in_active;
        //}
	return View::make('users.form')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		try {
			/*$validator = Validator::make(Input::all(), lb_users::$destroy);
			if ($validator->fails()) {
				return Redirect::back()->withErrors($validator)->withInput(Input::except("pass"));
			}*/

			$user = lb_users::find($id);
			$user->in_active = 0;
			$user->save();

			DB::commit();
			Session::flash('done', 'User Inactive!');
			return Redirect::to('users');
		}catch (\Exception $e)
		{
			DB::rollback();
			return Redirect::back()->withErrors([
				'done' => array('ERROR ('.$e->getCode().'):'=> $e->getMessage())
			]);
		}
    }
}
