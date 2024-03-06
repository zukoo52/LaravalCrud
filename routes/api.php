<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CustormerController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
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
//Route::post('/product-test',[ProductController::class,'productTest']);


//Route::post('/custormer-test',[CustormerController::class,'custormerTest']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::apiResource('student' ,StudentController::class);
Route::apiResource('hospital' ,HospitalController::class);
Route::apiResource('doctor' ,DoctorController::class);
Route::apiResource('patient' ,PatientController::class);
Route::resource('appointments', AppointmentController::class);


