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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', 'API\RegisterController@register');
Route::post('login', 'API\RegisterController@login');


Route::group(['middleware' => ['auth:api','changeLanguage'], 'namespace' => 'API'], function (){
    Route::post('Grades', 'GradeController@index');
    Route::post('Grades/{id}', 'GradeController@show');
    Route::post('Grades1/{id}','GradeController@update');
    Route::delete('Grades/{id}', 'GradeController@destroy');
    Route::post('Grades-store', 'GradeController@store');
});

Route::group(['prefix' => 'Classrooms','middleware' => ['auth:api','changeLanguage'], 'namespace' => 'API'], function (){
    Route::post('index', 'ClassroomController@index');
    Route::post('show/{id}', 'ClassroomController@show');
    Route::post('update/{id}','ClassroomController@update');
    Route::delete('delete/{id}', 'ClassroomController@destroy');
    Route::post('store', 'ClassroomController@store');
});


// Route::middleware('auth:api')->group( function (){
//     Route::resource('Grades', 'API\GradeController');
// });
