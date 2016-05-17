<?php

namespace linebacker\Http\Controllers;
//*******agregar esta linea******//
use linebacker\lb_users;
use linebacker\lb_contacts;
use Auth;
use Input;
use Response;
use Validator;
use Crypt;
use DB;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;
//*******************************//
use Illuminate\Http\Request;

use linebacker\Http\Requests;
use linebacker\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$data = lb_contacts::select('userAcc','id','first_name','last_name','primary_phone','second_phone','third_phone')
	//->where('userAcc', '=', $id)
	->get()->toArray();

	$fractal = new Manager();


	$resource = new Collection($data, function($data) {
	    return [	$data['userAcc'] => [
				(int) $data['id'] => [
					'first_name'  => $data['first_name'],
					'last_name' => $data['last_name'],
					'phones'  => [
						'0'  => $data['primary_phone'],
						'1' => $data['second_phone'],
						'2' => $data['third_phone'],
					]
				]
		]
	    ];
	});

	$data = $fractal->createData($resource)->toArray();

	return Response::json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	DB::beginTransaction();
	   try {
		$validate= Validator::make(Input::all(), lb_contacts::$new);
		if ($validate->fails()){
			return Response::json(array(
				'success' => false,
				'msg' => $validate->getMessageBag()->toArray()
			)); 
		}
		$contacts = new lb_contacts;
		$contacts->first_name = Input::get("first_name");
		$contacts->last_name = Input::get("last_name");
		$contacts->primary_phone = Input::get("primary_phone");
		$contacts->second_phone = Input::get("second_phone");
		$contacts->third_phone = Input::get("third_phone");
		$contacts->id = Auth::user()->id;
		$contacts->save();

		DB::commit();
		return Response::json(array(
			'success' => true,
			'msg' => 'Contact created!'
		)); 

	      }catch (\Illuminate\Database\QueryException $e)
	      {
			DB::rollback();
			return Response::json(array(
				'success' => false,
				'msg' => array('ERROR ('.$e->getCode().'):'=> $e->getMessage())
			)); 
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
	$data = lb_contacts::select('userAcc','id','first_name','last_name','primary_phone','second_phone','third_phone')
	->where('userAcc', '=', $id)
	->first();

	return Response::json(
		array(
			$data->userAcc => array( 
				$data->id => array( 
					'first_name' => $data->first_name, 'last_name' => $data->last_name, 'phones' => array( 
						'0' => $data->primary_phone, '1' => $data->second_phone, '2' => $data->third_phone )
						)
					)
			), 200
	);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
    public function login(Request $request) {  
        $username = Input::get('username');  
        $password = Input::get('password');  
   
        $userdata = array(  
            'username' => $username,  
            'password' => bcrypt($password), 
        );  
   
        $error = true;  
        $user = array();  
   
        if(Auth::attempt($userdata)) {  
            $error = false;  
            $user = array(  
                'id' => Auth::user()->id,  
                'email' => Auth::user()->email  
            );  
        }  
   
        return Response::json(array(  
            'error' => $error,  
            'user' => $user  
        ), 200);  
    }  
}
