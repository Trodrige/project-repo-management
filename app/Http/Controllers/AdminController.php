<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::where('role', 'admin')->orderBy('id','DESC')->paginate(10);
        return view('admin.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Display a listing of Valid admins.
     *
     * @return \Illuminate\Http\Response
     */
    public function validAdmins(Request $request)
    {
        $data = User::where(['is_admin' => 'valid', 'role' => 'admin'])->orderBy('id','DESC')->paginate(10);
        return view('admin.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Display a listing of admins pending validation.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendingAdmins(Request $request)
    {
        $data = User::where(['is_admin' => 'invalid', 'role' => 'admin'])->orderBy('id','DESC')->paginate(10);
        return view('admin.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        //
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
