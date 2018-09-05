<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Hash;
use App\User;
use App\Project;
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
  
   public function viewFinalYearProject(Request $request){
    $projects = DB::table('projects')
    ->select('projects.filename_pdf', 'zip_filename', 'title', 'id', 'type')
    ->where('projects.isvalid','=', 'valid')
    ->where('projects.type', '=', 'finalyear')
    ->get();        
    //$projects = Project::paginate(5);
    $num_of_projects = $projects->count();
        return view('admin.finalYearProjects')->with([
            'projects' => $projects,
        ]);
    }

    public function viewInternshipProject(Request $request){
    $projects = DB::table('projects')
    ->select('projects.filename_pdf', 'zip_filename', 'title', 'id', 'type')
    ->where('projects.isvalid','=', 'valid')
    ->where('projects.type', '=', 'internship')
    ->get();        
    //$projects = Project::paginate(5);
    $num_of_projects = $projects->count();

        return view('admin.internshipProjects')->with([
            'projects' => $projects,
        ]);
    }

    public function viewCourseProject(Request $request){
        $projects = DB::table('projects')
        ->select('projects.filename_pdf', 'zip_filename', 'title', 'id', 'type')
        ->where('projects.isvalid','=', 'valid')
        ->where('projects.type', '=', 'courseproject')
        ->get();        
        //$projects = Project::paginate(5);
        $num_of_projects = $projects->count();
        
            return view('admin.courseProject')->with([
                'projects' => $projects,
            ]);
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
    public function destroy(Request $request)
    {
        //
        $user = User::find($request->id);
        $projects = Project::where('admin_id', $request->id)->get();
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
