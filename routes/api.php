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
Route::middleware('TenantResolver')->get('/test', function () {
    return \App\Models\Tenant\Student::count(); // or just a string
});