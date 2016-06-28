<?php

namespace linebacker\Http\Controllers;

const DEFAULT_URL = 'https://linebacker.firebaseio.com/';
const DEFAULT_TOKEN = 'MIzw0yVWKa0AdFLZ9cRCBMMlwklf4RfxMuPazEcT';
const DEFAULT_PATH = '/membershipLevel/';

use linebacker\Http\Requests;
use linebacker\Http\Controllers\Controller;
use linebacker\lb_membership;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Input;
use Session;

class MembershipController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $membership = lb_membership::paginate(15);

        return view('admin.membership.index', compact('membership'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.membership.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        lb_membership::create($request->all());

        
            $membership = Input::get('description');
            $member = DB::table('lb_membership')->where('description', $membership)->first();
            $path = $member->idlb_membership;
            $arrMember= array(
            "levelName" => $member->description
            );
            Session::flash('flash_message', 'lb_membership added!');
            $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
            $firebase->set(DEFAULT_PATH.$path, $arrMember);
        return redirect('admin/membership');
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
        $membership = lb_membership::findOrFail($id);

        return view('admin.membership.show', compact('membership'));
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
        $membership = lb_membership::findOrFail($id);

        return view('admin.membership.edit', compact('membership'));
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
        
        $membership = lb_membership::findOrFail($id);
        $membership->update($request->all());

        Session::flash('flash_message', 'lb_membership updated!');

        return redirect('admin/membership');
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
        lb_membership::destroy($id);

        Session::flash('flash_message', 'lb_membership deleted!');

        return redirect('admin/membership');
    }
    public function sendMobile(){
        $account = DB::table('lb_account')->where('id', $id_user)->first();
        $user = DB::table('lb_users')->where('id', $id_user)->first();
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
                   "email" => $user->email,
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

}
