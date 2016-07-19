<?php

namespace linebacker\Http\Controllers;

use linebacker\lb_did;
use linebacker\lb_extensions_asterisk;
use linebacker\lb_sip_asterisk;
use linebacker\lb_cdr_asterisk;
use linebacker\lb_voicemail_asterisk;
use linebacker\Http\Requests;
use linebacker\Http\Controllers\Controller;
use linebacker\lb_extension;
use Illuminate\Http\Request;
use Session;
use DB;

const DEFAULT_URL = 'https://linebacker.firebaseio.com/';
const DEFAULT_TOKEN = 'MIzw0yVWKa0AdFLZ9cRCBMMlwklf4RfxMuPazEcT';
const DEFAULT_PATH = '/recordedAudiosByUser/';
date_default_timezone_set('America/New_York');

class ReportController extends Controller
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
        $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
        $jsondata = file_get_contents('https://linebacker.firebaseio.com/recordedAudiosByUser/.json'); 
        $array = json_decode($jsondata, true);
        
        // foreach ($$array as $key => $value) {
        //     echo $key;
        //     var_dump($value);           
        //  } 
        for ($i=0; $i < count($array); $i++) { 
            echo $i;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
         $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
        return view('admin.report.view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
    
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
       
    }
        
    

    
}
