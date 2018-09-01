<?php

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
 
Route::group(['middleware' => ['auth']], function() {
    //Route::resource('roles','RoleController');
    //Route::resource('users','UserController');
    Route::resource('projects','ProjectController');
    Route::get('/myprojects', 'ProjectController@index')->name('myprojects');
    Route::get('/my-invalid-projects', 'HomeController@viewMyInvalidProjects')->name('myinvalidprojects');
    Route::get('/{filename}', 'DownloadController@getFile')->name('getfile');
    Route::delete('myprojects/delete-project/{id}', 'ProjectController@destroy')->name('destroy');
    //Route::delete('myprojects/delete-invalid-project/{id}', 'ProjectController@destroy')->name('destroy');
    Route::get('/{filename_pdf}', 'DownloadController@getPdfFile')->name('getpdf');
});

/**
 * Admin routes
 */
Route::group(['middleware' => 'is_admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin');
    //Route::get('/projects', 'AdminController@getAllProjects');
    Route::get('/projects', 'AdminController@getAllProjects');
    Route::post('/validate', 'AdminController@store')->name('store');
    Route::get('final-year/projects/', 'AdminController@viewFinalYearProject');
    Route::get('/internship/projects/', 'AdminController@viewInternshipProject');
    Route::get('course/projects/', 'AdminController@viewCourseProject');
});