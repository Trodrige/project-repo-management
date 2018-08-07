<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Project;
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
    public function index()
    {
        // Get the currently authenticated user's ID...
        $id = Auth::id();

        if (Auth::check()) {
            $myprojects = Project::where('owner_id', $id)->paginate(20);
        }

        return view('myprojects')->with([
            'myprojects' => $myprojects,
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $doc = new Project;
    	$doc->title = $request->title;
        $doc->description = $request->description;
        $doc->type = $request->type;
        $doc->date_validated = $request->date_validated;
        $doc->filename_pdf = FileUpload::savefile($request,'filename_pdf');
        $doc->zip_filename = FileUpload::savezip($request,'zip_filename');
        $doc->owner_id = $request->owner_id;
        $doc->admin_id = $request->admin_id;
    	if ($doc->save()) {
            //return view('home');
            return redirect()->route('home')
                        ->with('success','Product created successfully.');
            
    	}
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
