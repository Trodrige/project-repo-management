<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\User;
use Illuminate\Support\Facades\Validator;
use DB;
use Hash;
use App\FileUpload;
 use File;
 use Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Project::orderBy('id','ASC')->paginate(20);
        $user = User::all();
        return view('project.index',compact('data'))
            ->with(['user' => $user, 'i' => ($request->input('page', 1) - 1) * 20]);
    }

    public function myprojects(Request $request)
    {
        $myprojects = Project::where('owner_id', Auth::user()->id)->orderBy('id','ASC')->paginate(20);
        $user = User::all();
        return view('myprojects',compact('myprojects'))
            ->with(['user' => $user, 'i' => ($request->input('page', 1) - 1) * 20]);
    }

    /**
     * Display a listing of Validated projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function validatedProjects(Request $request)
    {
        $data = Project::where('date_validated', '>', '0000-00-00')->orderBy('id','ASC')->paginate(20);
        $user = User::all();
        return view('project.index',compact('data'))
            ->with(['user' => $user, 'i' => ($request->input('page', 1) - 1) * 20]);
    }

    /**
     * Display a listing of pending or work in progress projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function wipProjects(Request $request)
    {
        $data = Project::where('date_validated', '0000-00-00')->orderBy('id','ASC')->paginate(20);
        $user = User::all();
        return view('project.index',compact('data'))
            ->with(['user' => $user, 'i' => ($request->input('page', 1) - 1) * 20]);
    }

    /**
     * Display a listing of finalYearProjects projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function finalYearProjects(Request $request)
    {
        $data = Project::where('type', 'final_year_project')->orderBy('id','ASC')->paginate(20);
        $user = User::all();
        return view('project.index',compact('data'))
            ->with(['user' => $user, 'i' => ($request->input('page', 1) - 1) * 20]);
    }

    /**
     * Display a listing of validated finalYearProjects projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function validatedFypProjects(Request $request)
    {
        $data = Project::where('type', 'final_year_project')->where('date_validated', '>', '0000-00-00')->orderBy('id','ASC')->paginate(20);
        $user = User::all();
        return view('project.index',compact('data'))
            ->with(['user' => $user, 'i' => ($request->input('page', 1) - 1) * 20]);
    }

    /**
     * Display a listing of work in progress (pending) finalYearProjects projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function wipFypProjects(Request $request)
    {
        $data = Project::where('type', 'final_year_project')->where('date_validated', '0000-00-00')->orderBy('id','ASC')->paginate(20);
        $user = User::all();
        return view('project.index',compact('data'))
            ->with(['user' => $user, 'i' => ($request->input('page', 1) - 1) * 20]);
    }

    /**
     * Display a listing of internshipProjects projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function internshipProjects(Request $request)
    {
        $data = Project::where('type', 'internship')->orderBy('id','ASC')->paginate(20);
        $user = User::all();
        return view('project.index',compact('data'))
            ->with(['user' => $user, 'i' => ($request->input('page', 1) - 1) * 20]);
    }

    /**
     * Display a listing of validated internship projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function validatedInternshipProjects(Request $request)
    {
        $data = Project::where('type', 'internship')->where('date_validated', '>', '0000-00-00')->orderBy('id','ASC')->paginate(20);
        $user = User::all();
        return view('project.index',compact('data'))
            ->with(['user' => $user, 'i' => ($request->input('page', 1) - 1) * 20]);
    }

    /**
     * Display a listing of work in progress (pending) internship projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function wipInternshipProjects(Request $request)
    {
        $data = Project::where('type', 'internship')->where('date_validated', '0000-00-00')->orderBy('id','ASC')->paginate(20);
        $user = User::all();
        return view('project.index',compact('data'))
            ->with(['user' => $user, 'i' => ($request->input('page', 1) - 1) * 20]);
    }

    /**
     * Display a listing of course projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function courseProjects(Request $request)
    {
        $data = Project::where('type', 'course')->orderBy('id','ASC')->paginate(20);
        $user = User::all();
        return view('project.index',compact('data'))
            ->with(['user' => $user, 'i' => ($request->input('page', 1) - 1) * 20]);
    }

    /**
     * Display a listing of validated course projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function validatedCourseProjects(Request $request)
    {
        $data = Project::where('type', 'course')->where('date_validated', '>', '0000-00-00')->orderBy('id','ASC')->paginate(20);
        $user = User::all();
        return view('project.index',compact('data'))
            ->with(['user' => $user, 'i' => ($request->input('page', 1) - 1) * 20]);
    }

    /**
     * Display a listing of work in progress (pending) course projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function wipCourseProjects(Request $request)
    {
        $data = Project::where('type', 'course')->where('date_validated', '0000-00-00')->orderBy('id','ASC')->paginate(20);
        $user = User::all();
        return view('project.index',compact('data'))
            ->with(['user' => $user, 'i' => ($request->input('page', 1) - 1) * 20]);
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
        //dd($request->all());
        $validate = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:1440',
            'type' => 'required|max:255',
        ]);

        if($validate->fails()){
            return redirect()->route('home')->withErrors($validate);
        }
        //
        $doc = new Project;
     	$doc->title = $request->title;
        $doc->description = $request->description;
        $doc->type = $request->type;
        $doc->date_validated = now();
        $doc->filename_pdf = FileUpload::savefile($request,'filename_pdf');
        $doc->zip_filename = FileUpload::savezip($request,'zip_filename');
        $doc->owner_id = $request->owner_id;
        $doc->admin_id = $request->admin_id;
     	if ($doc->save()) {
             //return view('home');
             return redirect()->route('home')->with('success','Project created successfully.');
     	}
        return redirect()->back()->with('failure', 'Failure saving project!!!');
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
        $project = Project::find($id);
         $project->delete();
         return redirect()->route('myprojects')->with('success','Project deleted successfully.');
    }
}
