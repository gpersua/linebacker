<?php

namespace linebacker\Http\Controllers;

use linebacker\lb_did;
use linebacker\lb_extensions_asterisk;
use linebacker\lb_sip_asterisk;
use linebacker\lb_voicemail_asterisk;
use linebacker\Http\Requests;
use linebacker\Http\Controllers\Controller;
use linebacker\lb_extension;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use SSH;
use DB;

class ExtensionController extends Controller
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
        $extension = lb_extension::paginate(15);
        return view('admin.extension.index', compact('extension'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.extension.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        lb_extension::create($request->all());

        Session::flash('flash_message', 'lb_extension added!');

        return redirect('admin/extension');
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
        $extension = lb_extension::findOrFail($id);
        $this->assignDid();
        return view('admin.extension.show', compact('extension'));
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
        $extension = lb_extension::findOrFail($id);

        return view('admin.extension.edit', compact('extension'));
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
        
        $extension = lb_extension::findOrFail($id);
        $extension->update($request->all());

        Session::flash('flash_message', 'lb_extension updated!');

        return redirect('admin/extension');
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
        $exten = lb_extension::where('did_extension', $id)->first();
        $ext_num = $exten->extension;
        $secret = $exten->secret;
        $account = Session::get('userAcc');
        
        /*$this->deleteExtLocal($ext_num);
        $this->deleteFindMeFollow($ext_num);
        $this->deleteFmgrps($ext_num);
        $this->deleteHints($ext_num);
        $this->deleteIntercom($ext_num);
        $this->deleteIvr($ext_num);
        $this->deleteDid($id, $ext_num);
        $this->deleteVoicemail($ext_num);
        $this->deleteParked($ext_num);
        $this->deleteDndHints($ext_num);
        $this->deleteSip($ext_num, $account, $secret);*/
        
        $voicemail_asterisk = new lb_voicemail_asterisk();
        $extensions = new lb_extensions_asterisk();
        $sip = new lb_sip_asterisk();

        $voicemail_asterisk->delete_voicemail($ext_num);
        $extensions->delete_extension($ext_num);
        $sip->delete_sip($ext_num);
        
        lb_extension::destroy($id);
        
        $did = new lb_did();
        lb_did::where('did', $id)->update(array('extension' => null, 'is_available' => 1));
        
        DB::commit();
        $this->scpConnect();
        //$this->sshConnect();
        
        Session::flash('flash_message', 'lb_extension deleted!');

        return redirect('admin/extension');
    }
        
    
    public function scpConnect()
    {
        return SSH::into('asterisk')->run(array(
              // 'scp root@linebacker.privacyprotector.org:/var/www/backend/storage/app/users/*  /etc/asterisk/',
               //'chown -R asterisk.asterisk /etc/asterisk/',
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
    public function deleteExtLocal($extension)
    {
        $file = 'app/users/extensions_additional.conf';
        $filename =  storage_path($file);
        $search = 'exten => *84'.$extension.',1,Goto(app-campon-toggle,*84,1)'.PHP_EOL.'exten => *84'.$extension.',hint,ccss:SIP/'.$extension.PHP_EOL.PHP_EOL.'exten => *'.$extension.',1,Macro(vm,'.$extension.',DIRECTDIAL,${IVR_RETVM})'.PHP_EOL.'exten => *'.$extension.',n,Goto(vmret,1)'.PHP_EOL.PHP_EOL.'exten => '.$extension.',1,Set(__RINGTIMER=${IF($["${DB(AMPUSER/'.$extension.'/ringtimer)}" > "0"]?${DB(AMPUSER/'.$extension.'/ringtimer)}:${RINGTIMER_DEFAULT})})'.PHP_EOL.PHP_EOL.'exten => '.$extension.',n,Macro(exten-vm,'.$extension.','.$extension.',0,0,0)'.PHP_EOL.'exten => '.$extension.',n(dest),Set(__PICKUPMARK=)'.PHP_EOL.'exten => '.$extension.',n,Macro(vm,'.$extension.',${DIALSTATUS},${IVR_RETVM})'.PHP_EOL.'exten => '.$extension.',n,Goto(vmret,1)'.PHP_EOL.'exten => '.$extension.',hint,SIP/'.$extension.'&Custom:DND'.$extension.',CustomPresence:'.$extension.PHP_EOL.'exten => vmb'.$extension.',1,Macro(vm,'.$extension.',BUSY,${IVR_RETVM})'.PHP_EOL.'exten => vmb'.$extension.',n,Goto(vmret,1)'.PHP_EOL.PHP_EOL.'exten => vmu'.$extension.',1,Macro(vm,'.$extension.',NOANSWER,${IVR_RETVM})'.PHP_EOL.'exten => vmu'.$extension.',n,Goto(vmret,1)'.PHP_EOL.'exten => vms'.$extension.',1,Macro(vm,'.$extension.',NOMESSAGE,${IVR_RETVM})'.PHP_EOL.'exten => vms'.$extension.',n,Goto(vmret,1)'.PHP_EOL.PHP_EOL.'exten => vmi'.$extension.',1,Macro(vm,'.$extension.',INSTRUCT,${IVR_RETVM})'.PHP_EOL.'exten => vmi'.$extension.',n,Goto(vmret,1)';
       $delete = ''.PHP_EOL;
       file_put_contents($filename, str_replace($search, $delete, file_get_contents($filename)));
    }
    
    public function deleteFindMeFollow($extension)
    {   
        $file = 'app/users/extensions_additional.conf';
        //$delete = PHP_EOL.';--== end of [ext-findmefollow] ==--;'.PHP_EOL;
        $delete=PHP_EOL;
        $filename =  storage_path($file);
        $search = 'exten => *21'.$extension.',1,Goto(app-fmf-toggle,*21,1)'.PHP_EOL.'exten => *21'.$extension.',hint,Custom:FOLLOWME'.$extension.PHP_EOL.PHP_EOL.'exten => FM'.$extension.',1,Goto('.$extension.',FM'.$extension.')'.PHP_EOL.'exten => '.$extension.',1,GotoIf($[ "${DB(AMPUSER/'.$extension.'/followme/ddial)}" = "EXTENSION" ]?ext-local,'.$extension.',1)'.PHP_EOL.'exten => '.$extension.',n(FM'.$extension.'),Macro(user-callerid,)'.PHP_EOL.'exten => '.$extension.',n,Set(DIAL_OPTIONS=${DIAL_OPTIONS}I)'.PHP_EOL.'exten => '.$extension.',n,Set(CONNECTEDLINE(num,i)='.$extension.')'.PHP_EOL.'exten => '.$extension.',n,Gosub(sub-presencestate-display,s,1('.$extension.'))'.PHP_EOL.'exten => '.$extension.',n,Set(CONNECTEDLINE(name)=${DB(AMPUSER/'.$extension.'/cidname)}${PRESENCESTATE_DISPLAY})'.PHP_EOL.'exten => '.$extension.',n,Set(FM_DIALSTATUS=${EXTENSION_STATE('.$extension.'@ext-local)})'.PHP_EOL.'exten => '.$extension.',n,Set(__EXTTOCALL=${EXTEN})'.PHP_EOL.'exten => '.$extension.',n,Set(__PICKUPMARK=${EXTEN})'.PHP_EOL.'exten => '.$extension.',n,Macro(blkvm-setifempty,)'.PHP_EOL.'exten => '.$extension.',n,GotoIf($["${GOSUB_RETVAL}" = "TRUE"]?skipov)'.PHP_EOL.'exten => '.$extension.',n,Macro(blkvm-set,reset)'.PHP_EOL.'exten => '.$extension.',n,Set(__NODEST=)'.PHP_EOL.'exten => '.$extension.',n(skipov),Set(RRNODEST=${NODEST})'.PHP_EOL.'exten => '.$extension.',n(skipvmblk),Set(__NODEST=${EXTEN})'.PHP_EOL.'exten => '.$extension.',n,GosubIf($[${DB_EXISTS(AMPUSER/'.$extension.'/followme/changecid)} = 1 & "${DB(AMPUSER/'.$extension.'/followme/changecid)}" != "default" & "${DB(AMPUSER/'.$extension.'/followme/changecid)}" != ""]?sub-fmsetcid,s,1())'.PHP_EOL.'exten => '.$extension.',n,Set(RecordMethod=Group)'.PHP_EOL.'exten => '.$extension.',n(checkrecord),Gosub(sub-record-check,s,1(exten,'.$extension.',))'.PHP_EOL.'exten => '.$extension.',n(skipsimple),Set(RingGroupMethod=ringallv2-prim)'.PHP_EOL.'exten => '.$extension.',n,Set(_FMGRP='.$extension.')'.PHP_EOL.'exten => '.$extension.',n(DIALGRP),GotoIf($[("${DB(AMPUSER/'.$extension.'/followme/grpconf)}"="ENABLED") | ("${FORCE_CONFIRM}"!="") ]?doconfirm)'.PHP_EOL.'exten => '.$extension.',n,Macro(dial,$[ ${DB(AMPUSER/'.$extension.'/followme/grptime)} + ${DB(AMPUSER/'.$extension.'/followme/prering)} ],${DIAL_OPTIONS},${DB(AMPUSER/'.$extension.'/followme/grplist)})'.PHP_EOL.'exten => '.$extension.',n,Goto(nextstep)'.PHP_EOL.'exten => '.$extension.',n(doconfirm),Macro(dial-confirm,$[ ${DB(AMPUSER/'.$extension.'/followme/grptime)} + ${DB(AMPUSER/'.$extension.'/followme/prering)} ],${DIAL_OPTIONS},${DB(AMPUSER/'.$extension.'/followme/grplist)},'.$extension.')'.PHP_EOL.'exten => '.$extension.',n(nextstep),Set(RingGroupMethod=)'.PHP_EOL.'exten => '.$extension.',n,GotoIf($["foo${RRNODEST}" != "foo"]?nodest)'.PHP_EOL.'exten => '.$extension.',n,Set(__NODEST=)'.PHP_EOL.'exten => '.$extension.',n,Set(__PICKUPMARK=)'.PHP_EOL.'exten => '.$extension.',n,Macro(blkvm-clr,)'.PHP_EOL.'exten => '.$extension.',n,Set(DIALSTATUS=${IF($["${FM_DIALSTATUS}"="NOT_INUSE"&"${DIALSTATUS}"!="CHANUNAVAIL"]?NOANSWER:${IF($["${DIALSTATUS}"="CHANUNAVAIL"|"${FM_DIALSTATUS}"="UNAVAILABLE"|"${FM_DIALSTATUS}"$'.PHP_EOL.'exten => '.$extension.',n,Goto(ext-local,'.$extension.',dest)'.PHP_EOL.'exten => '.$extension.',n(nodest),Noop(SKIPPING DEST, CALL CAME FROM Q/RG: ${RRNODEST})';

        file_put_contents($filename, str_replace($search, $delete, file_get_contents($filename)));

    }
    
    public function deleteFmgrps($extension)
    {
        $file = 'app/users/extensions_additional.conf';
        $filename =  storage_path($file);
        $delete=PHP_EOL;
        //$delete = PHP_EOL.';--== end of [fmgrps] ==--;'.PHP_EOL;
        
        $search = 'exten => _RG-'.$extension.'.,1,NoCDR()'.PHP_EOL.'exten => _RG-'.$extension.'.,n,Macro(dial,${DB(AMPUSER/'.$extension.'/followme/grptime)},${DIAL_OPTIONS}M(confirm^^^'.$extension.'),${EXTEN:7})';
        
        file_put_contents($filename, str_replace($search, $delete, file_get_contents($filename)));
        
    }
    public function deleteHints($extension)
    {
        $file = 'app/users/extensions_additional.conf';
        //$delete = PHP_EOL.';--== end of [ext-cf-hints] ==--;'.PHP_EOL;
        $delete=PHP_EOL;
        $filename =  storage_path($file);
        $search = 'exten => *96'.$extension.',1,Goto(app-cf-toggle,*96,1)'.PHP_EOL.'exten => *96'.$extension.',hint,Custom:DEVCF'.$extension.PHP_EOL.'exten => _*96'.$extension.'.,1,Set(toext=${EXTEN:6})'.PHP_EOL.'exten => _*96'.$extension.'.,n,Goto(app-cf-toggle,*96,setdirect)';
        
        file_put_contents($filename, str_replace($search, $delete, file_get_contents($filename)));
        
    }
    
    public function deleteIntercom($extension)
    {
        $file = 'app/users/extensions_additional.conf';
        $delete = PHP_EOL;
        $filename =  storage_path($file);
        $search = 'exten => *80'.$extension.',1,Goto(ext-intercom,${EXTEN},1)';
        
        file_put_contents($filename, str_replace($search, $delete, file_get_contents($filename)));
   
    }
    
    public function deleteIvr($extension)
    {
        $file = 'app/users/extensions_additional.conf';
        //$delete = PHP_EOL.';--== end of [from-did-direct-ivr] ==--;'.PHP_EOL;
        $delete=PHP_EOL;
        $filename =  storage_path($file);
        $search = 'exten => *'.$extension.',1,Macro(blkvm-clr,)'.PHP_EOL.'exten => *'.$extension.',n,Set(__NODEST=)'.PHP_EOL.'exten => *'.$extension.',n,Macro(vm,'.$extension.',DIRECTDIAL,${IVR_RETVM})'.PHP_EOL.'exten => *'.$extension.',n,GotoIf($["${IVR_RETVM}" = "RETURN" & "${IVR_CONTEXT}" != ""]?ext-local,vmret,playret)'.PHP_EOL.'exten => '.$extension.',1,Macro(blkvm-clr,)'.PHP_EOL.'exten => '.$extension.',n,Set(__NODEST=)'.PHP_EOL.'exten => '.$extension.',n,Goto(from-did-direct,'.$extension.',1)';
        
        file_put_contents($filename, str_replace($search, $delete, file_get_contents($filename)));
    }
    
    public function deleteDid($did, $extension)
    {
        $file = 'app/users/extensions_additional.conf';
        $filename =  storage_path($file);
        //$delete =PHP_EOL.';--== end of [ext-did-0002] ==--;'.PHP_EOL;
        $delete=PHP_EOL;
        $search = 'exten => '.$did.',1,Set(__FROM_DID=${EXTEN})'.PHP_EOL.'exten => '.$did.',n,Gosub(app-blacklist-check,s,1())'.PHP_EOL.'exten => '.$did.',n,Set(CDR(did)=${FROM_DID})'.PHP_EOL.'exten => '.$did.',n,ExecIf($[ "${CALLERID(name)}" = "" ] ?Set(CALLERID(name)=${CALLERID(num)}))'.PHP_EOL.'exten => '.$did.',n,Set(CHANNEL(musicclass)=default)'.PHP_EOL.'exten => '.$did.',n,Set(__MOHCLASS=default)'.PHP_EOL.'exten => '.$did.',n,GotoIf($["${__REVERSAL_REJECT}"="TRUE" & "${CHANNEL(reversecharge)}"="1" ]?macro-hangupcall)'.PHP_EOL.'exten => '.$did.',n,Set(__CALLINGPRES_SV=${CALLERPRES()})'.PHP_EOL.'exten => '.$did.',n,Set(CALLERPRES()=allowed_not_screened)'.PHP_EOL.'exten => '.$did.',n(dest-ext),Goto(from-did-direct,'.$extension.',1)';
        
        file_put_contents($filename, str_replace($search, $delete, file_get_contents($filename)));    
    }
    public function deleteVoicemail($extension)
    {
        $file = 'app/users/voicemail.conf';
        $filename =  storage_path($file);
        $search = $extension.' => 123456,'.$extension.',,,attach=no|saycid=no|envelope=no|delete=no';
        $delete = PHP_EOL;
        file_put_contents($filename, str_replace($search, $delete, file_get_contents($filename)));    
        
    }
    
     public function deleteParked($extension)
    {
        $file = 'app/users/extensions_additional.conf';
        $filename =  storage_path($file);
        //$delete = PHP_EOL.';--== end of [park-hints] ==--;'.PHP_EOL;
        $delete=PHP_EOL;
        $search = 'exten => *85'.$extension.',1,Macro(parked-call,,default)'.PHP_EOL.'exten => *85'.$extension.',hint,Custom:PARK'.$extension;
        
        file_put_contents($filename, str_replace($search, $delete, file_get_contents($filename))); 
    }
    
     public function deleteSip($extension, $account, $secret)
    {
        $file = 'app/users/sip_additional.conf';
        $filename =  storage_path($file);
        
        $search = '['.$extension.']'.PHP_EOL.'deny=0.0.0.0/0.0.0.0'.PHP_EOL.'secret='.$secret.PHP_EOL.'dtmfmode=rfc2833'.PHP_EOL.'canreinvite=no'.PHP_EOL.'context=from-internal'.PHP_EOL.'host=dynamic'.PHP_EOL.'trustrpid=yes'.PHP_EOL.'mediaencryption=no'.PHP_EOL.'sendrpid=pai'.PHP_EOL.'type=friend'.PHP_EOL.'nat=force_rport,comedia'.PHP_EOL.'port=5060'.PHP_EOL.'qualify=yes'.PHP_EOL.'qualifyfreq=60'.PHP_EOL.'transport=udp,tcp,tls'.PHP_EOL.'avpf=no'.PHP_EOL.'force_avp=no'.PHP_EOL.'icesupport=no'.PHP_EOL.'encryption=no'.PHP_EOL.'callgroup='.PHP_EOL.'pickupgroup='.PHP_EOL.'dial=SIP/'.$extension.PHP_EOL.'mailbox='.$extension.'@default'.PHP_EOL.'permit=0.0.0.0/0.0.0.0'.PHP_EOL.'callerid='.$account.' <'.$extension.'>'.PHP_EOL.'callcounter=yes'.PHP_EOL.'faxdetect=no';
        $delete = ''.PHP_EOL;

        file_put_contents($filename, str_replace($search, $delete, file_get_contents($filename))); 

    }  
    public function deleteDndHints($extension)
    {
        $file = 'app/users/extensions_additional.conf';
        //$delete = PHP_EOL.';--== end of [ext-dnd-hints] ==--;'.PHP_EOL;
        $delete=PHP_EOL;
        $filename =  storage_path($file);
        $search = 'exten => *76'.$extension.',1,Goto(app-dnd-toggle,*76,1)'.$extension.PHP_EOL.'exten => *76'.$extension.',hint,Custom:DEVDND'.$extension.PHP_EOL;
        
        file_put_contents($filename, str_replace($search, $delete, file_get_contents($filename)));
        
    }

}
