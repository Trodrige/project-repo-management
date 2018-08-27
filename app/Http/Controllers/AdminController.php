<?php
namespace App\Http\Controllers;

use DB;
use Hash;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function allUsers(Request $request)
    {
        $data = User::orderBy('id','ASC')->paginate(10);
        return view('admin.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Display a listing of the admins.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->all());
        $data = User::where('role', 'admin')->orderBy('id','ASC')->paginate(10);
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
        $data = User::where(['is_admin' => 'valid', 'role' => 'admin'])->orderBy('id','ASC')->paginate(10);
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
        $data = User::where(['is_admin' => 'invalid', 'role' => 'admin'])->orderBy('id','ASC')->paginate(10);
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
            return redirect()->route('admins')->withErrors($validate);
        }

        $user = new User;

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = 'admin';
        $user->is_admin = 'valid';

        $user->save();

        return redirect()->route('admins');
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
    public function destroy($id)
    {
        //
    }
}
