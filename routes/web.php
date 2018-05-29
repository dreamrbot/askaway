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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();
Route::get('/auth/activate', 'Auth\ActivationController@activate')->name('auth.activate');
Route::get('/auth/activate/resend', 'Auth\ActivationResendController@showResendForm')->name('auth.activate.resend');
Route::post('/auth/activate/resend', 'Auth\ActivationResendController@resend');
Route::resource('accounts', 'business_account_Controller');

Route::group(['middleware' => ['auth']], function(){
  Route::get('/upload',['as'=>'video.upload','uses'=>'VideoController@videoUpload']);
  Route::post('/upload',['as'=>'video.upload.post','uses'=>'VideoController@videoUploadPost']);

  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/home/dashboard', 'HomeController@dashboard')->name('home.dashboard');

  Route::resource('/user', 'AdminUserController');

  Route::post('/upload',['as'=>'video.upload.post','uses'=>'VideoController@videoUploadPost']);


  // Route::get('/upload', 'VideoUploadController@index');
  // Route::post('/upload', 'VideoUploadController@upload');
});



//Route::get('/profile', 'ProfileController@upload')->name('home');
