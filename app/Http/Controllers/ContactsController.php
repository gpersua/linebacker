<?php

namespace linebacker\Http\Controllers;

use linebacker\Http\Requests;
use linebacker\Http\Controllers\Controller;

use linebacker\lb_contacts;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Input;
use DB;
use Auth;
class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       // $contacts = lb_contacts::paginate(15);

       // return view('users.contacts.index', compact('contacts'));
        
        
         $acc = DB::table('lb_account')->where('id', Auth::User()->id)->value('userAcc');
      
        if (Auth::User()->is('admin')){ 
         $contacts = lb_contacts::paginate(15);
         return view('users.contacts.index', compact('contacts'))->with('contacts1',null);
        }else{
            $id = Auth::User()->id;
            $contacts1= lb_contacts::where('userAcc', '=', $acc);
       
         return view('users.contacts.index')->with(['contacts1'=>$contacts1,'contacts'=>null]);
        }
        
        
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.contacts.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
          // lb_contacts::create($request->all());
            $acc = DB::table('lb_account')->where('id', Auth::User()->id)->value('userAcc');
            $contact = new lb_contacts();
            $contact->userAcc = $acc;
            $contact->first_name = Input::get('first_name');
            $contact->last_name = Input::get('last_name');
            $contact->address = Input::get('address');
            $contact->email = Input::get('email');
            $contact->primary_phone = Input::get('primary_phone');
            $contact->second_phone = Input::get('second_phone');
            $contact->third_phone = Input::get('third_phone');
            $contact->save();

        Session::flash('flash_message', 'lb_contacts added!');

        return redirect('users/contacts');
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
        $contact = lb_contacts::findOrFail($id);

        return view('users.contacts.show', compact('contact'));
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
        $contact = lb_contacts::findOrFail($id);

        return view('users.contacts.edit', compact('contact'));
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
        
        $contact = lb_contacts::findOrFail($id);
        $contact->update($request->all());

        Session::flash('flash_message', 'lb_contacts updated!');

        return redirect('users/contacts');
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
        lb_contacts::destroy($id);

        Session::flash('flash_message', 'lb_contacts deleted!');

        return redirect('users/contacts');
    }

}
