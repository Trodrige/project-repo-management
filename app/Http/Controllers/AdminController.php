<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Project;
use Request;
use App\Validproject;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllProjects(){
        //$projects = Project::all();
        $projects = DB::table('projects')
        ->select('projects.filename_pdf', 'zip_filename', 'title', 'id', 'type')
        ->where('projects.isvalid','=', 'valid')
        ->get();
        return view('admin.allprojects')->with([
            'projects' => $projects,
        ]);
    }


    public function index()
    {

    $projects = DB::table('projects')
    ->select('projects.filename_pdf', 'zip_filename', 'title', 'id', 'type')
    ->where('projects.isvalid','=', 'invalid')
    ->get();        
    //$projects = Project::paginate(5);
    $num_of_projects = $projects->count();
    return view('admin.index')->with([
    'projects' => $projects,
    'num_of_projects' => $num_of_projects
    ]);
        
    }


    


    public function store(Request $request){
        $inputs = Request::all();
        //var_dump(input::all());
        //dd($inputs);
    
        $projects = $inputs;
        //dd($projects);
        foreach ($projects as $project){
            $valdoc = new Project;
            $valdoc->project_id = $project;
            //$valdoc->save();
            DB::table('projects')
                ->where('id', $project)
                ->update(['isvalid'=> 'valid']);
                //dd($project);
            /*$project = new Project;
            $project->project_id = $project;
            //dd($projects);
            //$projects->save();
            DB::table('projects')
                ->where('id', $project)
                ->update(['isvalid'=> 'valid']);
                dd($project);
                return redirect()->back();
                //return redirect()->route('admin')->with('success','Project validated successfully.');*/
            }
            return redirect()->back();
        
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

}