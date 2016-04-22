<?php

namespace linebacker\Http\Controllers;

use linebacker\Http\Requests;
use linebacker\Http\Controllers\Controller;

use linebacker\lb_membership;
use Illuminate\Http\Request;
use Carbon\Carbon;
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

        Session::flash('flash_message', 'lb_membership added!');

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

}
