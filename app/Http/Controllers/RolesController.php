<?php

namespace linebacker\Http\Controllers;

use linebacker\Http\Requests;
use linebacker\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = \Bican\Roles\Models\Role::paginate(15);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        \Bican\Roles\Models\Role::create($request->all());

        Session::flash('flash_message', 'BicanRolesModelsRole added!');

        return redirect('admin/roles');
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
        $role = \Bican\Roles\Models\Role::findOrFail($id);

        return view('admin.roles.show', compact('role'));
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
        $role = \Bican\Roles\Models\Role::findOrFail($id);

        return view('admin.roles.edit', compact('role'));
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
        
        $role = \Bican\Roles\Models\Role::findOrFail($id);
        $role->update($request->all());

        Session::flash('flash_message', 'BicanRolesModelsRole updated!');

        return redirect('admin/roles');
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
        \Bican\Roles\Models\Role::destroy($id);

        Session::flash('flash_message', 'BicanRolesModelsRole deleted!');

        return redirect('admin/roles');
    }

}
