<?php
/****
 * Controlador del Modulo de Reclamos
 *
*/
namespace linebacker\Http\Controllers;

use Illuminate\Http\Request;

use linebacker\Http\Requests;
use linebacker\Http\Controllers\Controller;
use linebacker\lb_contacts;
use Carbon\Carbon;
use Session;
use Input;
use DB;
use Auth;

class FilingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //acceso a la vista del modulo Filing a Case en la plantilla index

       return view('users.filing.index');

        //return view('users.filing.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //acceso a la vista del modulo Filing a Case en la accion crear nuevo caso
        return view('users.filing.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function edit($id)
    public function edit()
    {
        //acceso a la vista del modulo Filing a Case en la accion editar
        return view('users.filing.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
