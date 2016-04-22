<?php

namespace linebacker\Http\Controllers;

use linebacker\Http\Requests;
use linebacker\Http\Controllers\Controller;

use linebacker\lb_did;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class DidController extends Controller
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
        $did = lb_did::paginate(15);

        return view('admin.did.index', compact('did'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.did.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        lb_did::create($request->all());

        Session::flash('flash_message', 'lb_did added!');

        return redirect('admin/did');
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
        $did = lb_did::findOrFail($id);

        return view('admin.did.show', compact('did'));
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
        $did = lb_did::findOrFail($id);

        return view('admin.did.edit', compact('did'));
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
        
        $did = lb_did::findOrFail($id);
        $did->update($request->all());

        Session::flash('flash_message', 'lb_did updated!');

        return redirect('admin/did');
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
        lb_did::destroy($id);

        Session::flash('flash_message', 'lb_did deleted!');

        return redirect('admin/did');
    }

}
