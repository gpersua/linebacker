<?php

namespace linebacker\Http\Controllers;
/*Data for Firebase*/
const DEFAULT_URL = 'https://mrtest.firebaseio.com/';
const DEFAULT_TOKEN = 'S83nqJSI7PuDnT1mVKKcPfGmkOXp2yPQZtkL7oyB';
const DEFAULT_PATH = '/user/';
date_default_timezone_set('America/New_York');
/*Until here*/
use linebacker\Http\Requests;
use linebacker\Http\Controllers\Controller;
use linebacker\Http\Controllers\ExtensionController;
use linebacker\lb_membership;
use linebacker\lb_users_asterisk;
use linebacker\lb_findmefollow_asterisk;
use linebacker\lb_sip_asterisk;
use linebacker\lb_incoming_asterisk;
use linebacker\lb_account;
use linebacker\lb_did;
use linebacker\lb_extension;
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
        $account = lb_account::paginate(10);

        return view('users.account.index', compact('account'));
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
            $new_id=explode('-', Input::get('id_city'));
            $account = new lb_account();
            $account->id = Input::get("id");
            $account->id_membership = Input::get("id_membership");
            $account->id_city = $new_id[0];
            $account->first_name = Input::get('first_name');
            $account->last_name = Input::get('last_name');
            $account->address = Input::get('address');
            $account->birthday = Input::get('birthday');
            $account->phone_number = Input::get('phone_number');
            $account->second_phone = Input::get('second_phone');

            $account->save();

            $account = DB::table('lb_account')->where('id', Auth::User()->id)->value('userAcc');

            Session::put('userAcc', $account);

           /*Add Extension*/
            $sc = new lb_sip_asterisk();
            $secret=$sc->secret();
            
            $route_did = $this->assignDid();
            $extension = new lb_extension();
            if ($extension->is_empty()==0){
                $ext_num = 733;
            }else{
                $ext = lb_extension::select('extension')->orderby('extension','desc')->first();
                $ext_num = $ext->extension + 1;

            }
            $account = Session::get('userAcc');
             
            $this->generateExtLocal($ext_num);
            $this->generateFindMeFollow($ext_num);
            $this->generateFmgrps($ext_num);
            $this->generateHints($ext_num);
            $this->generateIntercom($ext_num);
            $this->generateIvr($ext_num);
            $this->generateDid($route_did['did'], $ext_num);
            $this->generateVoicemail($ext_num);
            $this->generateParked($ext_num);
            $this->generateDndHints($ext_num);
            $this->generateSip($ext_num, $account, $secret);
            

            $extension->did_extension = $route_did['did'];
            $extension->extension = $ext_num;
            $extension->server_url = 'http://voip.mylinebacker.net/';
            $extension->userAcc = $account;
            $extension->secret = $secret;

            $extension->save();

            $did = new lb_did();
            lb_did::where('did', $route_did['did'])->update(array('extension' => $ext_num, 'is_available' => 0));
            DB::commit();

            $sip = new lb_sip_asterisk(); 
            $sip->sipInsert($ext_num, $secret);
            
            /*Populate users extensions*/
            $user_asterisk = new lb_users_asterisk;

            $user_asterisk->extension = $ext_num;
            $user_asterisk->password = '';
            $user_asterisk->name = $account;
            $user_asterisk->voicemail = 'default';
            $user_asterisk->ringtimer =0;
            $user_asterisk->save();
            /*Until here*/
            /*Populate Findmefollow*/
            $findmefollow = new lb_findmefollow_asterisk;
            $findmefollow->grpnum = $ext_num;
            $findmefollow->strategy = 'ringallv2-prim';
            $findmefollow->grptime = 20;
            $findmefollow->grppre = '';
            $findmefollow->grplist = $ext_num;
            $findmefollow->annmsg_id = 0;
            $findmefollow->postdest = 'ext-local,'.$ext_num.',dest';
            $findmefollow->dring ='';
            $findmefollow->remotealert_id =0;
            $findmefollow->needsconf ='';
            $findmefollow->toolate_id = 0;
            $findmefollow->pre_ring = 7;
            $findmefollow->ringing = 'Ring';
            $findmefollow->save();
            /*Until here*/
             /*Populate incoming*/
            $incoming = new lb_incoming_asterisk;
            $incoming->cidnum = '';
            $incoming->extension = $route_did['did'];
            $incoming->destination =  'from-did-direct,'.$ext_num.',1';
            $incoming->faxexten = NULL;
            $incoming->faxemail = NULL;
            $incoming->answer =NULL;
            $incoming->wait =NULL;
            $incoming->privacyman =0;
            $incoming->alertinfo ='';
            $incoming->ringing = '';
            $incoming->mohclass = 'default';
            $incoming->description = $account;
            $incoming->grppre = '';
            $incoming->delay_answer=0;
            $incoming->pricid = '';
            $incoming->pmmaxretries =3;
            $incoming->pmminlength =10;
            $incoming->reversal ='';
            $incoming->save();
            /*Until here*/
            
            $this->scpConnect();
            $this->sshConnect();
            
            $this->sendMobile();
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

        return view('users.account.edit', compact('account'));
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
        
        $account = lb_account::findOrFail($id);
        $account->update($request->all());

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
        if($exten){
        $ext=new ExtensionController();
        $ext->destroy($exten->did_extension);
        lb_account::destroy($id);
        }else{
            lb_account::destroy($id);
        }

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
	    $results[] = [ 'id' => $res->idlb_city, 'value' => $res->idlb_city.'-'.$res->zip_code.' '.$res->name ];
	}
        return Response::json($results);
    
}


    public function assignDid(){
        $did = new lb_did();
        return $did->getDid();
    }
    
    public function generateExtLocal($extension)
    {
        $file = 'app/users/extensions_additional.conf';
        $filename =  storage_path($file);
        $search ='exten => vmret,1,GotoIf($["${IVR_RETVM}" = "RETURN" & "${IVR_CONTEXT}" != ""]?playret)';
        $insert = PHP_EOL.'exten => *84'.$extension.',1,Goto(app-campon-toggle,*84,1)'.PHP_EOL.'exten => *84'.$extension.',hint,ccss:SIP/'.$extension.PHP_EOL.PHP_EOL.'exten => *'.$extension.',1,Macro(vm,'.$extension.',DIRECTDIAL,${IVR_RETVM})'.PHP_EOL.'exten => *'.$extension.',n,Goto(vmret,1)'.PHP_EOL.PHP_EOL.'exten => '.$extension.',1,Set(__RINGTIMER=${IF($["${DB(AMPUSER/'.$extension.'/ringtimer)}" > "0"]?${DB(AMPUSER/'.$extension.'/ringtimer)}:${RINGTIMER_DEFAULT})})'.PHP_EOL.PHP_EOL.'exten => '.$extension.',n,Macro(exten-vm,'.$extension.','.$extension.',0,0,0)'.PHP_EOL.'exten => '.$extension.',n(dest),Set(__PICKUPMARK=)'.PHP_EOL.'exten => '.$extension.',n,Macro(vm,'.$extension.',${DIALSTATUS},${IVR_RETVM})'.PHP_EOL.'exten => '.$extension.',n,Goto(vmret,1)'.PHP_EOL.'exten => '.$extension.',hint,SIP/'.$extension.'&Custom:DND'.$extension.',CustomPresence:'.$extension.PHP_EOL.'exten => vmb'.$extension.',1,Macro(vm,'.$extension.',BUSY,${IVR_RETVM})'.PHP_EOL.'exten => vmb'.$extension.',n,Goto(vmret,1)'.PHP_EOL.PHP_EOL.'exten => vmu'.$extension.',1,Macro(vm,'.$extension.',NOANSWER,${IVR_RETVM})'.PHP_EOL.'exten => vmu'.$extension.',n,Goto(vmret,1)'.PHP_EOL.'exten => vms'.$extension.',1,Macro(vm,'.$extension.',NOMESSAGE,${IVR_RETVM})'.PHP_EOL.'exten => vms'.$extension.',n,Goto(vmret,1)'.PHP_EOL.PHP_EOL.'exten => vmi'.$extension.',1,Macro(vm,'.$extension.',INSTRUCT,${IVR_RETVM})'.PHP_EOL.'exten => vmi'.$extension.',n,Goto(vmret,1)'.PHP_EOL.$search.PHP_EOL;
       file_put_contents($filename, str_replace($search, $insert, file_get_contents($filename)));
    }
    
    public function generateFindMeFollow($extension)
    {   
        ini_set('memory_limit', '7000M');
        $file = 'app/users/extensions_additional.conf';
        $search = ';--== end of [ext-findmefollow] ==--;';
        $filename =  storage_path($file);
        
        $insert = 'exten => *21'.$extension.',1,Goto(app-fmf-toggle,*21,1)'.PHP_EOL.'exten => *21'.$extension.',hint,Custom:FOLLOWME'.$extension.PHP_EOL.PHP_EOL.'exten => FM'.$extension.',1,Goto('.$extension.',FM'.$extension.')'.PHP_EOL.'exten => '.$extension.',1,GotoIf($[ "${DB(AMPUSER/'.$extension.'/followme/ddial)}" = "EXTENSION" ]?ext-local,'.$extension.',1)'.PHP_EOL.'exten => '.$extension.',n(FM'.$extension.'),Macro(user-callerid,)'.PHP_EOL.'exten => '.$extension.',n,Set(DIAL_OPTIONS=${DIAL_OPTIONS}I)'.PHP_EOL.'exten => '.$extension.',n,Set(CONNECTEDLINE(num,i)='.$extension.')'.PHP_EOL.'exten => '.$extension.',n,Gosub(sub-presencestate-display,s,1('.$extension.'))'.PHP_EOL.'exten => '.$extension.',n,Set(CONNECTEDLINE(name)=${DB(AMPUSER/'.$extension.'/cidname)}${PRESENCESTATE_DISPLAY})'.PHP_EOL.'exten => '.$extension.',n,Set(FM_DIALSTATUS=${EXTENSION_STATE('.$extension.'@ext-local)})'.PHP_EOL.'exten => '.$extension.',n,Set(__EXTTOCALL=${EXTEN})'.PHP_EOL.'exten => '.$extension.',n,Set(__PICKUPMARK=${EXTEN})'.PHP_EOL.'exten => '.$extension.',n,Macro(blkvm-setifempty,)'.PHP_EOL.'exten => '.$extension.',n,GotoIf($["${GOSUB_RETVAL}" = "TRUE"]?skipov)'.PHP_EOL.'exten => '.$extension.',n,Macro(blkvm-set,reset)'.PHP_EOL.'exten => '.$extension.',n,Set(__NODEST=)'.PHP_EOL.'exten => '.$extension.',n(skipov),Set(RRNODEST=${NODEST})'.PHP_EOL.'exten => '.$extension.',n(skipvmblk),Set(__NODEST=${EXTEN})'.PHP_EOL.'exten => '.$extension.',n,GosubIf($[${DB_EXISTS(AMPUSER/'.$extension.'/followme/changecid)} = 1 & "${DB(AMPUSER/'.$extension.'/followme/changecid)}" != "default" & "${DB(AMPUSER/'.$extension.'/followme/changecid)}" != ""]?sub-fmsetcid,s,1())'.PHP_EOL.'exten => '.$extension.',n,Set(RecordMethod=Group)'.PHP_EOL.'exten => '.$extension.',n(checkrecord),Gosub(sub-record-check,s,1(exten,'.$extension.',))'.PHP_EOL.'exten => '.$extension.',n(skipsimple),Set(RingGroupMethod=ringallv2-prim)'.PHP_EOL.'exten => '.$extension.',n,Set(_FMGRP='.$extension.')'.PHP_EOL.'exten => '.$extension.',n(DIALGRP),GotoIf($[("${DB(AMPUSER/'.$extension.'/followme/grpconf)}"="ENABLED") | ("${FORCE_CONFIRM}"!="") ]?doconfirm)'.PHP_EOL.'exten => '.$extension.',n,Macro(dial,$[ ${DB(AMPUSER/'.$extension.'/followme/grptime)} + ${DB(AMPUSER/'.$extension.'/followme/prering)} ],${DIAL_OPTIONS},${DB(AMPUSER/'.$extension.'/followme/grplist)})'.PHP_EOL.'exten => '.$extension.',n,Goto(nextstep)'.PHP_EOL.'exten => '.$extension.',n(doconfirm),Macro(dial-confirm,$[ ${DB(AMPUSER/'.$extension.'/followme/grptime)} + ${DB(AMPUSER/'.$extension.'/followme/prering)} ],${DIAL_OPTIONS},${DB(AMPUSER/'.$extension.'/followme/grplist)},'.$extension.')'.PHP_EOL.'exten => '.$extension.',n(nextstep),Set(RingGroupMethod=)'.PHP_EOL.'exten => '.$extension.',n,GotoIf($["foo${RRNODEST}" != "foo"]?nodest)'.PHP_EOL.'exten => '.$extension.',n,Set(__NODEST=)'.PHP_EOL.'exten => '.$extension.',n,Set(__PICKUPMARK=)'.PHP_EOL.'exten => '.$extension.',n,Macro(blkvm-clr,)'.PHP_EOL.'exten => '.$extension.',n,Set(DIALSTATUS=${IF($["${FM_DIALSTATUS}"="NOT_INUSE"&"${DIALSTATUS}"!="CHANUNAVAIL"]?NOANSWER:${IF($["${DIALSTATUS}"="CHANUNAVAIL"|"${FM_DIALSTATUS}"="UNAVAILABLE"|"${FM_DIALSTATUS}"$'.PHP_EOL.'exten => '.$extension.',n,Goto(ext-local,'.$extension.',dest)'.PHP_EOL.'exten => '.$extension.',n(nodest),Noop(SKIPPING DEST, CALL CAME FROM Q/RG: ${RRNODEST})'.PHP_EOL.$search.PHP_EOL;

        file_put_contents($filename, str_replace($search, $insert, file_get_contents($filename)));

    }
    
    public function generateFmgrps($extension)
    {
        $file = 'app/users/extensions_additional.conf';
        $filename =  storage_path($file);
        
        $search = ';--== end of [fmgrps] ==--;';
        
        $insert = PHP_EOL.'exten => _RG-'.$extension.'.,1,NoCDR()'.PHP_EOL.'exten => _RG-'.$extension.'.,n,Macro(dial,${DB(AMPUSER/'.$extension.'/followme/grptime)},${DIAL_OPTIONS}M(confirm^^^'.$extension.'),${EXTEN:7})'.PHP_EOL.$search.PHP_EOL;
        
        file_put_contents($filename, str_replace($search, $insert, file_get_contents($filename)));
    }
    public function generateHints($extension)
    {
        $file = 'app/users/extensions_additional.conf';
        $search =';--== end of [ext-cf-hints] ==--;';
        $filename =  storage_path($file);
        $insert = PHP_EOL.'exten => *96'.$extension.',1,Goto(app-cf-toggle,*96,1)'.PHP_EOL.'exten => *96'.$extension.',hint,Custom:DEVCF'.$extension.PHP_EOL.'exten => _*96'.$extension.'.,1,Set(toext=${EXTEN:6})'.PHP_EOL.'exten => _*96'.$extension.'.,n,Goto(app-cf-toggle,*96,setdirect)'.PHP_EOL.$search.PHP_EOL;
        
        file_put_contents($filename, str_replace($search, $insert, file_get_contents($filename)));
        
    }
    public function generateDndHints($extension)
    {
        $file = 'app/users/extensions_additional.conf';
        $search =';--== end of [ext-dnd-hints] ==--;';
        $filename =  storage_path($file);
        $insert = PHP_EOL.'exten => *76'.$extension.',1,Goto(app-dnd-toggle,*76,1)'.$extension.PHP_EOL.'exten => *76'.$extension.',hint,Custom:DEVDND'.$extension.PHP_EOL.$search.PHP_EOL;
        
        file_put_contents($filename, str_replace($search, $insert, file_get_contents($filename)));
        
    }
    
    public function generateIntercom($extension)
    {
        $file = 'app/users/extensions_additional.conf';
        $search = ';--== end of [ext-intercom-users] ==--;';
        $filename =  storage_path($file);
        $insert = 'exten => *80'.$extension.',1,Goto(ext-intercom,${EXTEN},1)'.PHP_EOL.$search.PHP_EOL;
        
        file_put_contents($filename, str_replace($search, $insert, file_get_contents($filename)));
   
    }
    
    public function generateIvr($extension)
    {
        $file = 'app/users/extensions_additional.conf';
        $search = ';--== end of [from-did-direct-ivr] ==--;';
        $filename =  storage_path($file);
        $insert = PHP_EOL.'exten => *'.$extension.',1,Macro(blkvm-clr,)'.PHP_EOL.'exten => *'.$extension.',n,Set(__NODEST=)'.PHP_EOL.'exten => *'.$extension.',n,Macro(vm,'.$extension.',DIRECTDIAL,${IVR_RETVM})'.PHP_EOL.'exten => *'.$extension.',n,GotoIf($["${IVR_RETVM}" = "RETURN" & "${IVR_CONTEXT}" != ""]?ext-local,vmret,playret)'.PHP_EOL.'exten => '.$extension.',1,Macro(blkvm-clr,)'.PHP_EOL.'exten => '.$extension.',n,Set(__NODEST=)'.PHP_EOL.'exten => '.$extension.',n,Goto(from-did-direct,'.$extension.',1)'.PHP_EOL.$search.PHP_EOL;
        
        file_put_contents($filename, str_replace($search, $insert, file_get_contents($filename)));
    }
    
    public function generateDid($did, $extension)
    {
        $file = 'app/users/extensions_additional.conf';
        $filename =  storage_path($file);
        $search =';--== end of [ext-did-0002] ==--;';
        $insert = PHP_EOL.'exten => '.$did.',1,Set(__FROM_DID=${EXTEN})'.PHP_EOL.'exten => '.$did.',n,Gosub(app-blacklist-check,s,1())'.PHP_EOL.'exten => '.$did.',n,Set(CDR(did)=${FROM_DID})'.PHP_EOL.'exten => '.$did.',n,ExecIf($[ "${CALLERID(name)}" = "" ] ?Set(CALLERID(name)=${CALLERID(num)}))'.PHP_EOL.'exten => '.$did.',n,Set(CHANNEL(musicclass)=default)'.PHP_EOL.'exten => '.$did.',n,Set(__MOHCLASS=default)'.PHP_EOL.'exten => '.$did.',n,GotoIf($["${__REVERSAL_REJECT}"="TRUE" & "${CHANNEL(reversecharge)}"="1" ]?macro-hangupcall)'.PHP_EOL.'exten => '.$did.',n,Set(__CALLINGPRES_SV=${CALLERPRES()})'.PHP_EOL.'exten => '.$did.',n,Set(CALLERPRES()=allowed_not_screened)'.PHP_EOL.'exten => '.$did.',n(dest-ext),Goto(from-did-direct,'.$extension.',1)'.PHP_EOL.$search.PHP_EOL;
        
        file_put_contents($filename, str_replace($search, $insert, file_get_contents($filename)));    
    }
    public function generateVoicemail($extension)
    {
        $file = 'app/users/voicemail.conf';
        $filename =  storage_path($file);
        $insert = PHP_EOL.$extension.' => 123456,'.$extension.',,,attach=no|saycid=no|envelope=no|delete=no'.PHP_EOL;
        file_put_contents($filename, $insert, FILE_APPEND);
    }
    
     public function generateParked($extension)
    {
        $file = 'app/users/extensions_additional.conf';
        $filename =  storage_path($file);
        $search =';--== end of [park-hints] ==--;';
        $insert = PHP_EOL.'exten => *85'.$extension.',1,Macro(parked-call,,default)'.PHP_EOL.'exten => *85'.$extension.',hint,Custom:PARK'.$extension.PHP_EOL.$search.PHP_EOL;
        
        file_put_contents($filename, str_replace($search, $insert, file_get_contents($filename))); 
    }
    
     public function generateSip($extension, $account, $secret)
    {
        $file = 'app/users/sip_additional.conf';
        $filename =  storage_path($file);
        $insert = '['.$extension.']'.PHP_EOL.'deny=0.0.0.0/0.0.0.0'.PHP_EOL.'secret='.$secret.PHP_EOL.'dtmfmode=rfc2833'.PHP_EOL.'canreinvite=no'.PHP_EOL.'context=from-internal'.PHP_EOL.'host=dynamic'.PHP_EOL.'trustrpid=yes'.PHP_EOL.'mediaencryption=no'.PHP_EOL.'sendrpid=pai'.PHP_EOL.'type=friend'.PHP_EOL.'nat=force_rport,comedia'.PHP_EOL.'port=5060'.PHP_EOL.'qualify=yes'.PHP_EOL.'qualifyfreq=60'.PHP_EOL.'transport=udp,tcp,tls'.PHP_EOL.'avpf=no'.PHP_EOL.'force_avp=no'.PHP_EOL.'icesupport=no'.PHP_EOL.'encryption=no'.PHP_EOL.'callgroup='.PHP_EOL.'pickupgroup='.PHP_EOL.'dial=SIP/'.$extension.PHP_EOL.'mailbox='.$extension.'@default'.PHP_EOL.'permit=0.0.0.0/0.0.0.0'.PHP_EOL.'callerid='.$account.' <'.$extension.'>'.PHP_EOL.'callcounter=yes'.PHP_EOL.'faxdetect=no'.PHP_EOL;

                file_put_contents($filename, $insert, FILE_APPEND);

 }
    
    public function scpConnect()
    {
        return SSH::run(array(
               'scp  /var/www/backend/storage/app/users/*  root@104.156.226.161:/etc/asterisk/',
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
  
    public function sendMobile(){
        $account = DB::table('lb_account')->where('id', Auth::User()->id)->first();
        $extension = DB::table('lb_extension')->where('userAcc', $account->userAcc)->first();
        $city =  DB::table('lb_city')->where('idlb_city', $account->id_city)->first();
        $state =  DB::table('lb_state')->where('idlb_city', $city->idlb_state)->first();
        $path = $account->userAcc;
        $arr = array( 
	           "address" => $account->address,
	           "asteriskDid" => $extension->did_extension,
                   "asteriskExtension" => $extension->extension,
                   "birthday" => $account->birthday,
                   "creationDate" => $account->created_at,
                   "email" => Auth::User()->email,
                   "firstName" => $account->firstName,
                   "gcmRegistrationId" => '',
                   "lastName" => $account->lastName,
                   "phoneNumber" => $account->phone_number,
                   "city" => $city->name,
                   "state" => $state->name,
                   "zipCode"=> $city->zip_code
        );
        $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
        $firebase->set(DEFAULT_PATH.$path.'/', $arr);
    }
}
