<?php

 namespace App;

 use Illuminate\Support\Facades\Storage;
 use Illuminate\Http\File;

 class FileUpload
 {
     public static function savefile($request,$fileName,$default="")
     {
             $name = "";
             $filename_pdf = $request->filename_pdf;
             if ($request->hasFile($fileName))
             {
                 $extension=$filename_pdf->getClientOriginalExtension();
                 $name=rand(11111,99999).".".date('Y-m-d').".".time().".".$extension;

                 if($request->filled("filename_pdf")){
                     $this->validate($request, [
                     'filename_pdf' => 'file|mimes:pdf|max:20000'
                     ]);
                 }

                 if($request->hasFile('filename_pdf')){
                     if($request->file('filename_pdf')->isValid()){
                         return Storage::putFile('public', $request->file('filename_pdf'));
                     }
                 }

                 $name=$name;
             }else{
                 $name=$default;
             }
     }



     public static function savezip($request,$fileName,$default="")
     {
             $name = "";
             $zip_filename = $request->zip_filename;
             if ($request->hasFile($fileName))
             {
                 $extension=$zip_filename->getClientOriginalExtension();
                 $name=rand(11111,99999).".".date('Y-m-d').".".time().".".$extension;

                 if($request->filled("zip_filename")){
                     $this->validate($request, [
                     'zip_filename' => 'file|mimes:zip|max:20000'
                     ]);
                 }

                 if($request->hasFile('zip_filename')){
                     if($request->file('zip_filename')->isValid()){
                         return Storage::putFile('public', $request->file('zip_filename'));
                     }
                 }

                 $name=$name;
             }else{
                 $name=$default;
             }
     }
 }
 
