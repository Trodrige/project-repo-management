<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\User;
use App\Studentrequest;
use Illuminate\Support\Facades\Validator;
use DB;
use Hash;
use App\FileUpload;
use File;
use Storage;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

class ProjectController extends Controller
{

    private function sendSMS($to_number, $from_number, $message)
    {
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $appSid     = config('app.twilio')['TWILIO_APP_SID'];
        $client = new Client($accountSid, $authToken);
        try
        {
            // Use the client to do fun stuff like send text messages!
            $client->messages->create(
            // the number you'd like to send the message to
                $to_number,
               array(
                     // A Twilio phone number you purchased at twilio.com/console
                     'from' => $from_number,
                     // the body of the text message you'd like to send
                     'body' => $message
                 )
             );
       }
       catch (Exception $e)
       {
            echo "Error: " . $e->getMessage();
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->sendSMS('+237673574562', '+15867881191', 'Thank you bro!!!');
        $data = Project::orderBy('id','ASC')->paginate(20);
        $user = User::all();
        return view('project.index',compact('data'))
            ->with(['user' => $user, 'i' => ($request->input('page', 1) - 1) * 20]);
    }

    public function myprojects(Request $request)
    {
        $myprojects = Project::where('owner_id', Auth::user()->id)->orderBy('id','ASC')->paginate(20);
        //$user = User::all();
        $user = User::find(Auth::user()->id);
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
        //dd($request->all());
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
     * Show the list of students' requests.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentRequests(Request $request)
    {
        $data = Studentrequest::paginate(20);
        $user = User::all();
        $project = Project::all();
        //dd($data);
        return view('admin.studentrequests', compact('data'))
        ->with(['user' => $user, 'project' => $project, 'i' => ($request->input('page', 1) - 1) * 20]);
    }

    /**
     * Store new student requests.
     *
     * @return \Illuminate\Http\Response
     */
    public function addRequest(Request $request)
    {
        //dd($request->all());
        $studentrequest = new Studentrequest;

        $studentrequest->status = 'pending';
        $studentrequest->student_id = Auth::user()->id;
        $studentrequest->project_id = $request->project;

        $studentrequest->save();

        return redirect()->back()->with('success', 'Your request has been sent.');
    }

    /**
     * Store new student requests.
     *
     * @return \Illuminate\Http\Response
     */
    public function grantRequest(Request $request)
    {
        //dd($request->all());
        $studentrequest = Studentrequest::find($request->studentrequest);
        $student = User::find($studentrequest->student_id);
        $project = Project::find($studentrequest->project_id);
        //dd($studentrequest);
        $studentrequest->status = 'granted';
        $studentrequest->save();

        $project->owner_id = $studentrequest->student_id;
        $project->save();

        return redirect()->back()->with('success', 'Your request has been sent.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteRequest(Request $request)
    {
        $studentrequest = Studentrequest::find($request->id);

        $studentrequest->delete();

        if(!$studentrequest){ // If for some reason system feature isn't created, fire error message
            return back()->with('failure', 'An error occured while deleting student request. Try again!!!');
        }

        return back()->with('success', 'Deleted student request, '.$studentrequest->title);
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
        //dd($request->all());
        $validate = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:1440',
            'type' => 'required|max:255',
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate);
        }

        $project = Project::find($request->id);

        $project->title = $request->title;
        $project->description = $request->description;
        $project->type = $request->type;
        $project->save();

        if(!$project){ // If for some reason user isn't created, fire error message
            return back()->with('failure', 'An error occured while saving project. Fill all fields!!!');
        }

        return back()->with('success', 'Updated project '.$request->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('projects')->where('id', $id)->delete();
        //$project->delete();
        return redirect()->route('myinvalidprojects')->with('success','Wrong Id');
    }
}
