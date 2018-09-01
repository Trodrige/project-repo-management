<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Project;
use DB;

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
    public function index()
    {
        /*DB::table('projects')
                ->where('isvalid', 'valid')->get();*/
        $projects = DB::table('projects')
                ->select('projects.title', 'projects.id', 'projects.description', 'projects.type')
                ->where('projects.isvalid','=', 'valid')
                ->get();        
        //$projects = Project::paginate(5);
        $num_of_projects = $projects->count();
        return view('home')->with([
            'projects' => $projects,
            'num_of_projects' => $num_of_projects
        ]);
    }

    public function viewMyInvalidProjects(Request $request){

        $id = Auth::id();

        if (Auth::check()) {
            $myprojects = Project::where('user_id', $id)->paginate(3);
        }

        $myprojects = DB::table('projects')
        ->select('projects.filename_pdf', 'zip_filename', 'title', 'id', 'type')
        ->where('projects.isvalid','=', 'invalid')
        ->get();        
        //$projects = Project::paginate(5);
        $num_of_projects = $myprojects->count();
        
            return view('myInValidProjects')->with([
                'myprojects' => $myprojects,
                'num_of_projects' => $num_of_projects
            ]);
        }

    /*function getFile($filename){

        
    	$file=Storage::disk('public')->get($filename);

		return (new Response($file, 200))
              ->header('Content-Type', 'application/zip');

        $files = Storage::files("public");
        $zip_filename=array();
        foreach ($files as $key => $value) {
            $value= str_replace("public/","",$value);
            array_push($zip_filename,$value);
        }
        //return view('myprojects' , compact('projects'))->with(['zip_filename' => $zip_filename,]);
        //return view('myprojects', ['zip_filename' => $zip_filename]);
        //return redirect()->route('getfile', ['zip_filename' => $zip_filename]);
        //return view('myprojects', compact('projects'));
    }*/
}
