<?php
namespace linebacker\Http\Controllers;
/*Data for Firebase*/
const DEFAULT_URL = 'https://linebacker.firebaseio.com/';
const DEFAULT_TOKEN = 'MIzw0yVWKa0AdFLZ9cRCBMMlwklf4RfxMuPazEcT';
const DEFAULT_PATH = '/user/';
const DEFAULT_SETTINGS_PATH = '/setting/';
const DEFAULT_CONTACTS = '/contactsByUser/';
date_default_timezone_set('America/New_York');
/*Until here*/
use linebacker\Http\Requests;
use linebacker\Http\Controllers\Controller;
use linebacker\Http\Controllers\ExtensionController;
use linebacker\lb_membership;
use linebacker\lb_voicemail_asterisk;
use linebacker\lb_extensions_asterisk;
use linebacker\lb_sip_asterisk;
use linebacker\lb_incoming_asterisk;
use linebacker\lb_account;
use linebacker\lb_did;
use linebacker\lb_extension;
use linebacker\lb_city;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use Input;
use DB;
use Response;
use Validator;
use Redirect;
use SSH;
use View;
class AccountController extends Controller
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
     * @return Response
     */
    public function index()
    {
        $acc = DB::table('lb_account')->where('id', Auth::User()->id)->value('userAcc');
      //  var_dump(Auth::User()->is('admin'));
        if (Auth::User()->is('admin')){ 
        $account = lb_account::paginate(10);
        return view('users.account.index', compact('account'))->with('account1',null);
        }else{
    //var_dump(Auth::User()->id);
            $id = Auth::User()->id;
            //var_dump($acc);
             //$account1=lb_account::where('userAcc', '=', $acc)->first();
       $account1 = lb_account::select('id', 'userAcc', 'id_membership', 'id_city', 'first_name', 'last_name', 'address', 'birthday', 'phone_number', 'second_phone')
	->where('userAcc', '=', $acc)
	->first();
       // ->paginate(10);*/
         return view('users.account.index')->with(['account1'=>$account1,'account'=>null]);
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $membership = lb_membership::lists('description', 'idlb_membership');
        return view('users.account.create', compact('membership'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make(Input::all(), lb_account::$new);
            if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput(Input::except("pass"));
            }    
            $new_id=explode('.', Input::get('id_city'));
            $account = new lb_account();
            $account->id = Input::get("id");
            $account->id_membership = Input::get("id_membership");
            $account->id_city = $new_id[0];
            $account->city = trim($new_id[1]);
            $account->first_name = Input::get('first_name');
            $account->last_name = Input::get('last_name');
            $account->address = Input::get('address');
            $account->birthday = Input::get('birthday');
            $account->phone_number = Input::get('phone_number');
            $account->second_phone = Input::get('second_phone');

            $account->save();

            $acc = DB::table('lb_account')->where('id', Auth::User()->id)->value('userAcc');

            Session::put('userAcc', $acc);

           /*Add Extension*/
            $sc = new lb_sip_asterisk();
            $secret=$sc->secret();
            
            $route_did = $this->assignDid();
            $extension = new lb_extension();
            if ($extension->is_empty()==0){
                $ext_num = 7802;
            }else{
                $ext = lb_extension::select('extension')->orderby('extension','desc')->first();
                $ext_num = $ext->extension + 1;

            }
            $account = Session::get('userAcc');

            $extension->did_extension = $route_did['did'];
            $extension->extension = $ext_num;
            $extension->server_url = 'http://voip.mylinebacker.net/';
            $extension->userAcc = $account;
            $extension->secret = $secret;

            $extension->save();

            $did = new lb_did();
            lb_did::where('did', $route_did['did'])->update(array('extension' => $ext_num, 'is_available' => 0));
            DB::commit();
            
            /*Populate users extensions*/
            $this->generaExtension($ext_num, $secret, $route_did['did']);
            /*Until here*/
           //////////////// $this->scpConnect();
            //$this->sshConnect();
            
            $this->sendMobile($account);
            Session::flash('flash_message', 'extension added!');
            return redirect('users/account');
    }catch (\Exception $e)
    {
            DB::rollback();
            return Redirect::back()->withErrors([
                    'msg' => array('ERROR ('.$e->getCode().'):'=> $e->getMessage())
            ]);
    }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $account = lb_account::findOrFail($id);
        
        return view('users.account.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $account = lb_account::findOrFail($id);
        $membership = lb_membership::lists('description', 'idlb_membership');
        //return view('users.account.create', compact('membership'));
        //return view('users.account.edit', compact('account'));
        return view('users.account.edit')->with('account',$account)->with('membership',$membership);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        //var_dump(Input::get('birthday'));
            $account = lb_account::findOrFail($id);
            $new_id=explode('.', Input::get('id_city'));
            $account = new lb_account();
            $account->id = $id;
            $account->id_membership = Input::get("id_membership");
            $account->id_city = $new_id[0];
            if(count($new_id)>1){
                $city = trim($new_id[1]);
            }else{
                $city = $account->city;
            }
            $account->first_name = Input::get('first_name');
            $account->last_name = Input::get('last_name');
            $account->address = Input::get('address');
            $account->birthday = Input::get('birthday');
            $account->phone_number = Input::get('phone_number');
            $account->second_phone = Input::get('second_phone');
            
            DB::table('account')
            ->where('userAcc', $id)
            ->update(['id_membership' => Input::get("id_membership"), 'id_city' => $new_id[0], 'city' => $city, 'first_name' =>  Input::get('first_name'), 'last_name' => Input::get('last_name'), 'address' => Input::get('address'), \Carbon\Carbon::parse(Input::get('birthday'))->format('Y-m-d'), 'phone_number' => Input::get('phone_number'), 'second_phone' => Input::get('second_phone')]);
            DB::commit();

//        $account->update($request->all());
        $this->sendMobile($id);
        Session::flash('flash_message', 'lb_account updated!');

        return redirect('users/account');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $exten = DB::table('lb_extension')->where('userAcc', $id)->first();
        $contacts = new lb_account();
        $contacts->delete_contacts($id);
        if($exten){
        $ext=new ExtensionController();
        $ext->destroy($exten->did_extension);
        lb_account::destroy($id);
        }else{
            lb_account::destroy($id);
        }
        $this->destroyMobile($id);

        Session::flash('flash_message', 'lb_account deleted!');

        return redirect('users/account');
    }
    
    public function getCity()
    {
        $query= Input::get('input');
        
    	$results = array();
	
	$queries = DB::table('lb_city')
		->where('name', 'LIKE', '%'.$query.'%')
		->orWhere('zip_code', 'LIKE', '%'.$query.'%')
		->take(10)->get();
	foreach ($queries as $res)
	{
	   // $results[] = [ 'id' => $res->idlb_city, 'value' => $res->zip_code.' '.$res->name.'-'.$res->idlb_city ];
           $results[] = [ 'id' => $res->idlb_city, 'value' => $res->zip_code.'. '.$res->name ];
	}
        return Response::json($results);
    
}


    public function assignDid(){
        $did = new lb_did();
        return $did->getDid();
    }
    
    public function generaExtension($extension, $secret, $did){
        $sip = new lb_sip_asterisk(); 
        $sip->sipInsert($extension, $secret);
        $voicemail_asterisk = new lb_voicemail_asterisk();
        $voicemail_asterisk->voicemailInsert($extension);
        $extensions = new lb_extensions_asterisk();
        $extensions->extensionInsert($extension, $did);
        
    }
    
     
    public function scpConnect()
    {
        return SSH::into('asterisk')->run(array(
            //   'scp root@linebacker.privacyprotector.org:/var/www/backend/storage/app/users/*  /etc/asterisk/',
            //   'chown -R asterisk.asterisk /etc/asterisk/',
               '/etc/init.d/asterisk reload',
               'exit'
              ));
    }
    public function sshConnect()
    {
        return SSH::into('asterisk')->run(array(
                '/etc/init.d/asterisk reload',
                //'asterisk -rvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv',
                //'dialplan reload',
                //'sip reload',
                //'exit',
                'exit'
            ));
    }
  
    public function sendMobile($acc){
        var_dump($acc);
        $account = DB::table('lb_account')->where('userAcc', $acc)->first();
        var_dump($account);
        $extension = DB::table('lb_extension')->where('userAcc', $account->userAcc)->first();
        $city =  DB::table('lb_city')->where('idlb_city', $account->id_city)->first();
        $state =  DB::table('lb_state')->where('idlb_state', $city->idlb_state)->first();
        $path = $account->userAcc;
        $arr = array( 
	           "address" => $account->address,
	           "asteriskDid" => $extension->did_extension,
                   "asteriskExtension" => $extension->extension,
                   "asteriskExtensionPass" => $extension->secret,
                   "birthday" => $account->birthday,
                   "creationDate" => $account->created_at,
                   "email" => Auth::User()->email,
                   "firstName" => $account->first_name,
                   "gcmRegistrationId" => '',
                   "lastName" => $account->last_name,
                   "phoneNumber" => $account->phone_number,
                   "city" => $account->city,
                   "state" => $state->name,
                   "zipCode"=> $city->zip_code
        );
        $arrSetting= array(
            "blockCalls" => true,
            "deleteAudiosEveryWeeks" => 4,
            "emailNotification" => false,
            "mobileNotification" => true
        );
        $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
        $firebase->set(DEFAULT_PATH.$path, $arr);
        $firebase->set(DEFAULT_SETTINGS_PATH.$path, $arrSetting);
    }
    
    public function destroyMobile($id){
        $path = $id;
        $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
        $firebase->set(DEFAULT_CONTACTS.$path, NULL);
        $firebase->set(DEFAULT_PATH.$path, null);
        $firebase->set(DEFAULT_SETTINGS_PATH.$path, null);
    }
}
