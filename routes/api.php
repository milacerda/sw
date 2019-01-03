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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// // Route::group(array('prefix' => '/'), function () {
// Route::middleware('auth:api')->group(function () {

//   Route::get('/', function () {
//       return response()->json(['message' => 'SW API', 'status' => 'Connected']);
//   });

//   Route::resource('planets', 'PlanetsController');
// });

// Route::get('/', function () {
//     return redirect('api');
// });

Route::post('login', 'API\UserController@login');

Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
});