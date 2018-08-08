<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use App\User;
use App\Project;
use App\Comment;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Pagination\Paginator;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $num_of_users = User::all()->count();
        $num_of_students = User::where('role', 'student')->count();
        $num_of_admins = User::where('role', 'admin')->orWhere('role', 'superadmin')->count();
        $num_of_valid_admins = User::where('role', 'admin')->where('is_admin', 'valid')->count();
        $num_of_invalid_admins = User::where('role', 'admin')->where('is_admin', 'invalid')->count();
        $num_of_projects = Project::all()->count();
        $num_of_validated_projects = Project::where('date_validated', '>', '0000-00-00')->count();
        $num_of_pending_projects = Project::where('date_validated', '0000-00-00')->count();
        $recent_projects = Project::all()->take(20);
        $comments = Comment::all()->count();
        $permissions = Permission::all()->count();
        $data = Project::orderBy('id','ASC')->paginate(20);
        return view('home',compact('data'))
            ->with([
                'i' => ($request->input('page', 1) - 1) * 20,
                'num_of_users' => $num_of_users,
                'num_of_students' => $num_of_students,
                'num_of_admins' => $num_of_admins,
                'num_of_valid_admins' => $num_of_valid_admins,
                'num_of_invalid_admins' => $num_of_invalid_admins,
                'num_of_projects' => $num_of_projects,
                'num_of_validated_projects' => $num_of_validated_projects,
                'num_of_pending_projects' => $num_of_pending_projects,
                'recent_projects' => $recent_projects,
                'comments' => $comments,
                'permissions' => $permissions,
            ]);
        /*$projects = Project::paginate(20);
        $num_of_projects = $projects->count();
        return view('home')->with([
            'projects' => $projects,
            'i' => ($request->input('page', 1) - 1) * 20
        ]);*/
    }
}
