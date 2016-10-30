<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Http\Requests\UserRequest;
use App\Http\Requests\Request;
use App\Http\Controllers\TaskController;
use App\User;
Route::get('/', function () {   
    return view('welcome');
});

Route::get('tasks', 'TaskController@index');
// GET By ID
Route::get('tasks/{task_id?}','TaskController@edit');
// Create
Route::post('tasks','TaskController@store');
// Update
Route::put('tasks/{task_id?}', 'TaskController@update' );
// Delete
Route::delete('tasks/{task_id?}','TaskController@destroy');



// Route Users
Route::get('/users', function () {
    $users = User::all();
    return view('users.manage' , [ 'title' => 'Users List','users' => $users ] );
});

Route::get('/users/{user_id?}',function($user_id){
    $user = User::find($user_id);
    return Response::json($user);
});

Route::post('/users',function(UserRequest $request){
   
    $data = $request->all();
    $data['password'] = Hash::make( $data['password'] );
    /*
    $userExist = User::where( 'email',  $data['email'] )->firstOrFail();
    if( $userExist ){
        $error = new stdClass();
        $error->stt  = 1;
        $error->msg  = 'Email exits';
        return Response::json($error);
    }
    */
    $user = User::create( $data );
    return Response::json($user);
});

Route::put('/users/{user_id?}',function(UserRequest $request, $user_id){
    $user = User::find($user_id);
    $user->name        = $request->name;
    $user->email       = $request->email;
    $user->save();
    return Response::json($user);
});

Route::delete('/users/{user_id?}',function($user_id){
    $user = User::destroy($user_id);
    return Response::json($user);
});