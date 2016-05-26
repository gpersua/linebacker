<?php

namespace linebacker\Http\Controllers;
//*******agregar esta linea******//
use linebacker\lb_users;
use linebacker\lb_contacts;
use linebacker\lb_account;
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

const DEFAULT_URL = 'https://linebacker.firebaseio.com/';
const DEFAULT_TOKEN = 'MIzw0yVWKa0AdFLZ9cRCBMMlwklf4RfxMuPazEcT';
const DEFAULT_PATH = '/contactsByUser';
const DEFAULT_PATH_USER = '/user/';

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
       // $acc = DB::table('lb_account')->where('id', Auth::User()->id)->value('userAcc');
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
		$contacts->userAcc = Input::get("userAcc");
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAll($id)
    {
       $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
        
        if($this->jsonToMysql($id)){
            return Response::json(array(
			'success' => true,
			'msg' => 'Contacts uploaded!'
		)); 
        }else{
            return Response::json(array(
				'success' => false,
				'msg' => 'Failed uploading'
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
        $username = Input::get('email');  
        $password = Input::get('password');  
   
        $userdata = array(  
            'email' => $username,  
            'password' => $password, 
        );  
   
        $error = true;  
        $user = array();  
          
        
        if(Auth::attempt($userdata)) {  
            //$error = false;  
            $errorId = array(
                'errorId' => 0,
                'errorMessage' => '',
                'resultObject' => '' 
            );
            $user = array(  
                'id' => Auth::user()->id,  
                'email' => Auth::user()->email  
            );  
        }  
   
        return Response::json(array(  
            'error' => $errorId,  
            'user' => $user  
        ), 200);  
    }
    public function cleanPhone($stringphone){
        set_time_limit(0);
        ini_set('max_execution_time', 0);
        $garbage= array( "-", "~","#", "@", "|","·", "$", "%", "&", "/","(", ")", "?", "'", "¡","¿", "[", "^", "<code>", "]","+", "}", "{", "¨", "´",">", "< ", ";", ",", ":",".", " ", "â", "€", "ª", "¬", "_", "“", "Â ", "â€¬", "â€“", "A", "a", "B", "b","C","c","D","d","E","e","F", "f","G","g","H","h","I","i","J","j","K","k","L","l","M","m","N","n","O","o","P","p","Q","q","R","r","S","s","T","t","U","u","V","v","W","w","X","x","Y","y","Z","z", "Â", "â","€","“");
        $result = str_replace($garbage,'',$stringphone);
        return $result;
    }
    public function jsonToMysql($id){
        
        $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
        
        //obtain from Firebase
        
        $jsondata = file_get_contents('https://linebacker.firebaseio.com/contactsByUser/'.$id.'.json'); 
	
	//echo $jsondata;
        
        $array = json_decode($jsondata, true);

        //var_dump( $array = json_decode($jsondata, true));
        $phone0='';
        $phone1='';
        $phone2='';
        $phone='phone';
        
        /*for ($i = 0; $i < count($array); $i++)
            {*/
                $account = new lb_account();
                $account->delete_contacts($id);
                foreach ($array as $key => $valor)
                    { 
                      $contact=new lb_contacts();
                      $iduser=$id;
                      //echo $iduser;
                      if($iduser==$id){
                      $extension = DB::table('lb_extension')->where('userAcc', $id)->first();
                      $did=$extension->did_extension;
                      $contact->userAcc = $iduser;
                      
                       /*if(!$contact->isEmptyTable()){
                           $contact->remove();
                       }*/
                      for($j=0; $j< count($key);$j++){
                          
                          foreach ($valor as $k){
//var_dump($k);
                          $id_contact=$k;
                          $name=$valor['name'];
                          if(count($key['emails'])!=0){
                                $contact->email=$key[0];
                                //echo $key[0];
                          }
                          
                             if(isset($valor['phones'][0])){
				  $phone0=$this->cleanPhone($valor['phones'][0]);
                                 // echo $phone0;
				  $contact->primary_phone=$phone0;
                              }  else {
                              $phone0=NULL;    
                              }
                              if (isset($valor['phones'][1])) {
                                  $phone1=$this->cleanPhone($valor['phones'][1]);
                              }else{
                                  $phone1=NULL;
                              }   
                              if (isset($valor['phones'][2])) {
                                $phone2=$this->cleanPhone($valor['phones'][2]);
                              }
                              else {$phone2=NULL;}
                              
                              $contact->first_name = $name;
                              
                         } 
                     }
                                $contact->second_phone = $phone1;
                                $contact->third_phone = $phone2;
                                $contact->save();
                              }
                        }
                            
                          
                         //}
                        return true; 
                    }
}
