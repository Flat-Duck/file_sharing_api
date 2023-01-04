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
    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('groups', 'HomeController@groups');
        Route::get('groups/{group}', 'HomeController@group');
        Route::get('groups/{group}/assignments', 'HomeController@assignments');
        Route::get('groups/{group}/materials', 'HomeController@materials');
        Route::get('groups/{group}/announcements', 'HomeController@announcements');
        Route::get('assignments/{post}', 'HomeController@assignment');
        Route::get('materials/{post}', 'HomeController@material');

        Route::get('/password', 'HomeController@updatePassword');
        Route::post('/password', 'HomeController@updatePassword');
        
    });
});
