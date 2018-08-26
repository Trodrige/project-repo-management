<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Project;

class DownloadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    

    function getFile($filename){
        /*
        $file_path = storage_path('public') . "/" . $filename;
        $headers = ['Content-Type: application/zip'];
        $name = Storage::disk('public')->get($filename);
        return response()->download($file_path, $name, $headers);

       */
    	$file=Storage::disk('public')->get($filename);

		return (new Response($file, 200))
              ->header('Content-Type', 'application/zip');
        
        $files = Storage::files("public");
        $zip_filename=array();
        foreach ($files as $key => $value) {
            $value= str_replace("public/","storage/",$value);
            array_push($zip_filename,$value);
        }
        return response()->download($value);
        //return view('myprojects' , compact('projects'))->with(['zip_filename' => $zip_filename,]);
        //return view('myprojects', ['zip_filename' => $zip_filename]);
        //return redirect()->route('getfile', ['zip_filename' => $zip_filename]);
        //return view('myprojects', compact('projects'));
    }

    function getPdfFile($filename){

        
    	$file=Storage::disk('public')->get($filename);

		return (new Response($file, 200))
              ->header('Content-Type', 'application/pdf');

        $files = Storage::files("public");
        $zip_filename=array();
        foreach ($files as $key => $value) {
            $value= str_replace("public/","storage/",$value);
            array_push($zip_filename,$value);
        }
        //return view('myprojects' , compact('projects'))->with(['zip_filename' => $zip_filename,]);
        //return view('myprojects', ['zip_filename' => $zip_filename]);
        //return redirect()->route('getfile', ['zip_filename' => $zip_filename]);
        //return view('myprojects', compact('projects'));
    }
}