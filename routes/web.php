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
//use App\Http\Middleware\Access;

Route::get('/', 'HomeController@welcome')->name('/');

Auth::routes();

Route::group(['middleware'=>'Access:1'], function(){
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/edit_profile', 'UserController@editProfile')->name('edit_profile');
Route::PUT('/update_profile', 'UserController@updateProfile')->name('update_profile');
Route::get('/job/apply/{id}', 'JobController@apply_job')->name('apply_job');
});

Route::group(['middleware'=>'Access:2'], function(){
Route::get('/company', 'JobController@company')->name('company');
Route::get('/job/add', 'JobController@add_job')->name('add_job');
Route::post('/job/store', 'JobController@job_store')->name('job_store');
Route::get('/job/applicants/{id}', 'JobController@applicants')->name('applicants');
});