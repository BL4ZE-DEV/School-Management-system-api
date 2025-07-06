<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::get("/", function(){
    var_dump( "hello");
});


Route::post('/create-user', [UserController::class, 'store']);


Route::get('/test2', function(){
    return "yhh yhhyh hy h";
});

Route::post('/login',  [UserController::class, 'login']);

Route::middleware('tenant')->get('/test', function () {
    return "something"; // or just a string
});