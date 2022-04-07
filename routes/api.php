<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\ProjectController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('list-employees',[ApiController::class,'ListEmployees']);
Route::get('single-employee/{id}',[ApiController::class,'getSingleEmployee']);
Route::post('add-employee',[ApiController::class,'createEmployee']);
Route::put('update-employee/{id}',[ApiController::class,'updateEmployee']);
Route::delete('delete-employee/{id}',[ApiController::class,'deleteEmployee']);



Route::post('register',[StudentController::class,'register']);
Route::post('login',[StudentController::class,'login']);

Route::group(["middleware"=>["auth:sanctum"]], function(){

Route::get('profile',[StudentController::class,'profile']);
Route::get('logout',[StudentController::class,'logout']);



   //project
  Route::post('create-project',[ProjectController::class,'create']);
  Route::get('list-project',[ProjectController::class,'list']);
  Route::get('single-project/{id}',[ProjectController::class,'single']);
  Route::delete('delete-project/{id}',[ProjectController::class,'delete']);

});


