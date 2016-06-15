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
        
        $voicemail_asterisk = new lb_voicemail_asterisk();
        $extensions = new lb_extensions_asterisk();
        $sip = new lb_sip_asterisk();

        $voicemail_asterisk->delete_voicemail($ext_num);
        $extensions->delete_extension($id);
        $sip->delete_sip($ext_num);
        
        lb_extension::destroy($id);
        
        $did = new lb_did();
        lb_did::where('did', $id)->update(array('extension' => null, 'is_available' => 1));
        
        DB::commit();
        ////////$this->scpConnect();
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
    
}
