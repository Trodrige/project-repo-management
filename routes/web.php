<?php

use App\Http\Middleware\IsAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Input;
use App\Project;
use App\Validproject;

Route::get('/', function () {
    return redirect('home');
});

//Route::get('/account', function () {
//    return view('auth.account');
//});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); // show all projects in the system

/**
 * Admin routes
 
Route::group(['middleware' => 'is_admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin');
    //Route::get('/projects', 'AdminController@getAllProjects');
    Route::get('/projects', 'AdminController@getAllProjects');
    Route::post('/validate', 'AdminController@store')->name('store');
    Route::get('final-year/projects/', 'AdminController@viewFinalYearProject');
    Route::get('/internship/projects/', 'AdminController@viewInternshipProject');
    Route::get('course/projects/', 'AdminController@viewCourseProject');
});*/

//Route::get('/myprojects', 'ProjectController@index')->name('myprojects');

Route::group(['middleware' => ['auth']], function() {

    //Route::resource('roles','RoleController');
    //Route::resource('users','UserController');
    Route::resource('projects','ProjectController');

    Route::get('/adminprofile', 'AdminController@profile')->middleware('is_admin')->name('adminprofile');
    Route::get('/settings', 'AdminController@settings')->middleware('is_admin')->name('settings');

    Route::get('/users', 'AdminController@allUsers')->middleware('is_admin')->name('users');

    Route::get('/admins', 'AdminController@index')->middleware('is_admin')->name('admins');
    Route::get('/validadmins', 'AdminController@validAdmins')->middleware('is_admin')->name('validadmins');
    Route::get('/pendingadmins', 'AdminController@pendingAdmins')->middleware('is_admin')->name('pendingadmins');

    Route::post('/admin', 'AdminController@store')->middleware('is_admin')->name('createadmin');
    Route::patch('/admin/{id}', 'AdminController@update')->middleware('is_admin')->name('updateadmin');
    Route::delete('/admin/{id}', 'AdminController@destroy')->middleware('is_admin')->name('deleteadmin');


    Route::get('/students', 'StudentController@index')->middleware('is_admin')->name('students');
    Route::get('/finalyearstudents', 'StudentController@finalYearStudents')->middleware('is_admin')->name('finalyearstudents');
    Route::get('/internshipstudents', 'StudentController@internshipStudents')->middleware('is_admin')->name('internshipstudents');

    Route::post('/student', 'StudentController@store')->middleware('is_admin')->name('createstudent');
    Route::patch('/student/{id}', 'StudentController@update')->middleware('is_admin')->name('updatestudent');
    Route::delete('/student/{id}', 'StudentController@destroy')->middleware('is_admin')->name('deletestudent');

    Route::get('/projects', 'ProjectController@index')->name('projects');
    Route::get('/validatedprojects', 'ProjectController@validatedProjects')->name('validatedprojects');
    Route::get('/wipprojects', 'ProjectController@wipProjects')->name('wipprojects');

    Route::get('/finalyearprojects', 'ProjectController@finalYearProjects')->name('finalyearprojects');
    Route::get('/validatedfypprojects', 'ProjectController@validatedFypProjects')->name('validatedfypprojects');
    Route::get('/wipfypprojects', 'ProjectController@wipFypProjects')->name('wipfypprojects');

    Route::get('/internshipprojects', 'ProjectController@internshipProjects')->name('internshipprojects');
    Route::get('/validatedinternshipprojects', 'ProjectController@validatedInternshipProjects')->name('validatedinternshipprojects');
    Route::get('/wipinternshipprojects', 'ProjectController@wipInternshipProjects')->name('wipinternshipprojects');

    Route::get('/courseprojects', 'ProjectController@courseProjects')->name('courseprojects');
    Route::get('/validatedcourseprojects', 'ProjectController@validatedCourseProjects')->name('validatedcourseprojects');
    Route::get('/wipcourseprojects', 'ProjectController@wipCourseProjects')->name('wipcourseprojects');

    Route::get('/studentrequests', 'ProjectController@studentRequests')->middleware('is_admin')->name('studentrequests');
    Route::post('/addrequest', 'ProjectController@addRequest')->name('addrequest');
    Route::post('/grantrequest', 'ProjectController@grantRequest')->middleware('is_admin')->name('grantrequest');
    Route::delete('/deleterequest/{id}', 'ProjectController@deleteRequest')->middleware('is_admin')->name('deleterequest');

    Route::patch('/project/{id}', 'ProjectController@update')->middleware('is_admin')->name('updateproject');

     Route::get('/myprojects', 'ProjectController@myprojects')->name('myprojects');
     Route::get('/{filename}', 'DownloadController@getFile')->name('getfile');
     Route::delete('myprojects/delete-project/{id}', 'ProjectController@destroy')->name('destroy');
     Route::post('/{filename_pdf}', 'DownloadController@getPdfFile')->name('getpdf');
  
      Route::get('/my-invalid-projects', 'HomeController@viewMyInvalidProjects')->name('myinvalidprojects');

    //Route::resource('roles','RoleController');
    //Route::resource('users','AdminController');
    //Route::resource('projects','ProjectController');
});
