<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Project;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

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
        $data = Project::orderBy('id','DESC')->paginate(10);
        return view('home',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
        /*$projects = Project::paginate(20);
        $num_of_projects = $projects->count();
        return view('home')->with([
            'projects' => $projects,
            'i' => ($request->input('page', 1) - 1) * 20
        ]);*/
    }
}
