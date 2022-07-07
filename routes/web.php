<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('login');
});
Route::get('/login', function () {
    return view('login');
});

Route::get('/searchin', function () {
    return view('searchbar');
});
Route::get('/logout', function () {
    Session::forget('user');
    return redirect('login');
});
Route::get('/register', function () {
    return view('register');
});

Route::get('/editmyuser', function () {
    view('edituser');
});

Route::get('/userlist', function () {
    return view('userlist');
});

Route::get('/userprofile', function () {
    return view('user');
});


//Route::get('/searchin',[UserController::class,'search']);
Route::get('/userlist',[UserController::class,'search']);
//Route::post('/userlist',[UserController::class,'search']);
Route::get('/editmyuser',[UserController::class,'getuser']);
Route::post('/login',[UserController::class,'login']);
Route::post('/register',[UserController::class,'register']);
Route::post('/useredit',[UserController::class, 'edituser']);

Route::get('/userdelete',[UserController::class,'deleteuser']);