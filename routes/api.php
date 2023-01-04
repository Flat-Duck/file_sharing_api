<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::name("api.")->namespace('API')->group(function () {
    Route::post('/login', 'AuthController@login');
    Route::GET('/ajax/exam', 'AjaxController@exam');
    Route::GET('/ajax/students', 'AjaxController@students');
    Route::GET('/ajax/marks', 'AjaxController@marks');
    Route::GET('/ajax/time_table', 'AjaxController@time_table');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('groups', 'HomeController@groups');
        Route::get('groups/{group}', 'HomeController@group');
        Route::get('groups/{group}/assignments', 'HomeController@assignments');
        Route::get('groups/{group}/materials', 'HomeController@materials');
        Route::get('groups/{group}/announcements', 'HomeController@announcements');
        Route::get('assignments/{post}', 'HomeController@assignment');
        Route::get('materials/{post}', 'HomeController@material');



        Route::post('/chats', 'HomeController@send_chat');
        Route::get('main','HomeController@main');
        Route::get('{student}/notes','HomeController@notes');
        Route::get('{student}/attendances','HomeController@attendances');
        Route::get('{student}/subjects','HomeController@subjects'); 
        Route::get('{student}/exams','HomeController@exams');
        Route::get('{student}/marks','HomeController@marks');
        Route::get('{student}/time_tables','HomeController@time_tables');
        Route::get('{student}','HomeController@student');
        Route::get('/password', 'HomeController@updatePassword');
        Route::post('/password', 'HomeController@updatePassword');
        
    });
});
