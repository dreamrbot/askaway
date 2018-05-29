<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', 'API\UserController@register');
Route::get('/auth/activate', 'Auth\ActivationController@activate')->name('auth.activate');
Route::get('/auth/activate/resend', 'Auth\ActivationResendController@showResendForm')->name('auth.activate.resend');
Route::post('/auth/activate/resend', 'Auth\ActivationResendController@resend');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'user'], function(){
  Route::post('/login', 'API\UserController@login');
  Route::post('/login/refresh', 'API\UserController@refresh');
  Route::post('/logout', 'API\UserController@logout');
});




Route::group(['middleware' => 'auth:api'], function(){
        Route::group(['prefix' => 'profile'], function() {
          Route::post('/','ProfileController@store');
          Route::get('/', 'ProfileController@show');
          Route::patch('/edit','ProfileController@edit');

          Route::group(['prefix' => 'avatar'], function(){
            Route::post('/','AvatarController@store');
            Route::get('/', 'AvatarController@show');
            Route::patch('/edit','AvatarController@edit');
            Route::delete('/','AvatarController@destroy');
          });

          Route::group(['prefix' => 'stats'], function(){
            Route::get('/', 'StatisticsController@show');
          });

        });

        Route::group(['prefix' => 'questions'], function() {
          Route::post('/','QuestionController@store');
          Route::get('/', 'QuestionController@index');
          Route::get('/myQuestions', 'QuestionController@getQuestions');
          Route::get('/{question}', 'QuestionController@show');
          Route::delete('/{question}', 'QuestionController@destroy');

          Route::group(['prefix' => '/{question}/answers'], function(){
            Route::post('/', 'AnswerController@store');
            Route::get('/', 'AnswerController@index');
            Route::get('/{answer}', 'AnswerController@show');
            Route::patch('/{answer}', 'AnswerController@updateScore');
            Route::delete('/{answer}', 'AnswerController@destroy');

          });
        });

});
