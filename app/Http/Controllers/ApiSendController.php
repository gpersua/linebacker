<?php

namespace linebacker\Http\Controllers;
//*******agregar esta linea******//
use linebacker\lb_users;
use linebacker\lb_contacts;
use linebacker\lb_account;
use linebacker\lb_cdr_asterisk;
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
const DEFAULT_PATH = '/recordedAudiosByUser/';
date_default_timezone_set('America/New_York');
class ApiSendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$data = lb_cdr_asterisk::select('calldate', 'clid', 'src', 'dst', 'dcontext', 'channel', 'dstchannel', 'lastapp', 'lastdata', 'duration', 'billsec', 'disposition', 'amaflags', 'accountcode', 'uniqueid', 'userfield', 'did', 'recordingfile', 'user_id', 'is_contact', 'sent')
	//->where('userAcc', '=', $id)
	->get()->toArray();

	$fractal = new Manager();


	$resource = new Collection($data, function($data) {
	    return [	$data['user_id'] => [
				$data['id'] => [
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
    public function getAudioAll($id)
    {
        $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
        $data = lb_cdr_asterisk::select('calldate', 'clid', 'src', 'dst', 'dcontext', 'channel', 'dstchannel', 'lastapp', 'lastdata', 'duration', 'billsec', 'disposition', 'amaflags', 'accountcode', 'uniqueid', 'userfield', 'did', 'recordingfile', 'user_id', 'is_contact', 'sent')
	->where('user_id', '=', $id)
        ->where('sent', '=', 0)
	->get()->toArray();
        //var_dump($data);
        if( sizeof($data) != 0 ){ 
            foreach ($data as $key){
                /*$dt =substr($key['calldate'],0,10);
                $date_array = explode("-", $dt);
                $y=$date_array[0];
                $m=$date_array[1];
                $d=$date_array[2];*/
               if($key['is_contact']=="false")
                    $contact=false;
                else 
                    $contact=true;
              $id_part=explode(".", $key['recordingfile']); 
              $audio_id=$id_part[0];
              $minus_date=$key['uniqueid'];

                 $arr = array( //(int)$minus_date=> array(
                               "audioName" => $key['recordingfile'],
                               "callDate" => $key['calldate'],
                               "audioFileUrl" => 'http://linebacker.privacyprotector.org'.$key['recordingfile'],
                               "datetime" => (double)$key['uniqueid'],
                               "duration" => $key['duration'],
                               "isContact" => $contact,
                               "isOnCase" => false,
                               "wasAlreadyPlayed" => false,
                               "phoneNumber" => $key['src']
            //)
                    );
            $json_call = json_encode($arr);
            //echo $json_call;
            //var_dump($json_call);


            $date = date_create_from_format('Y-m-d H:i:s', $key['calldate']);
            //date_timestamp_get($minus_date);
            if(isset($key['user_id'])){

            $path=$key['user_id'];

            //$path = $path.date_timestamp_get($minus_date);

            //echo $path;
            $number=99999999999999;
            $a=$number-(int)$minus_date;
            //$clave=array((int)$minus_date=>(int)"1");
            //$firebase->set(DEFAULT_PATH.$path,$clave);
            $firebase->set(DEFAULT_PATH.$path.'/'.$a, $arr);
            //$firebase->push(DEFAULT_PATH.$path,$clave);
            $new_path=DEFAULT_PATH.$path.'/'.$a.'/';
            //echo $new_path;
            //$firebase->set($new_path, $arr);
            }
            lb_cdr_asterisk::where('user_id', $id)->update(array('sent' => 1));
            DB::commit();
            }
            
            return Response::json(array(
			'success' => true,
			'msg' => 'Audio Files downloaded!'
		)); 
        }else{
            return Response::json(array(
			'success' => false,
			'msg' => 'you do not have new calls'
            )); 
        }

        
       /*$firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
        
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
        }*/
     
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
}
