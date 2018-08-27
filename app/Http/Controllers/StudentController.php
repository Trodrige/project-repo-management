<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::where('role', 'student')->orderBy('id','ASC')->paginate(10);
        return view('student.index',compact('data'))
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
     * Store a newly created admin in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $validate = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        if($validate->fails()){
            return redirect()->route('students')->withErrors($validate);
        }

        $user = new User;

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = 'student';
        $user->is_admin = 'valid';

        $user->save();

        return redirect()->route('students');
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
        //dd($request->all());
        $validate = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|max:255',
            'is_admin' => 'required|max:255',
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate);
        }

        $user = User::find($request->id);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        //$user->password = $request->password;
        $user->role = $request->role;
        $user->is_admin = $request->is_admin;
        $user->save();

        if(!$user){ // If for some reason user isn't created, fire error message
            return back()->with('failure', 'An error occured while saving user. Fill all fields!!!');
        }

        return back()->with('success', 'Updated user '.$request->firstname);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $user = User::find($request->id);
        $projects = Project::where('owner_id', $request->id)->get();
        foreach ($projects as $key => $project) {
            $project->owner_id = Auth::user()->id;
            $project->admin_id = Auth::user()->id;
            $project->save();
        }

        $projects2 = Project::where('owner_id', $request->id)->get();
        foreach ($projects2 as $key => $project) {
            $project->owner_id = Auth::user()->id;
            $project->admin_id = Auth::user()->id;
            $project->save();
        }

        $user->delete();
        //dd($projects2);
        //$project->delete();

        if(!$user){ // If for some reason system feature isn't created, fire error message
            return back()->with('failure', 'An error occured while deleting user. Try again!!!');
        }

        return back()->with('success', 'Deleted user, '.$user->firstname);
    }
}
