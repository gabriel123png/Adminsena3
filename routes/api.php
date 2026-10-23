<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\TrainingCenterController;
use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseTeacherController;
use App\Http\Controllers\TeacherController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'API AdminSENA activa'
    ]);
});

// Rutas de API para Áreas
Route::apiResource('areas', AreaController::class);
Route::apiResource('computers', ComputerController::class);
Route::apiResource('training_centers', TrainingCenterController::class);
Route::apiResource('apprentices', ApprenticeController::class);
Route::apiResource('courses', CourseController::class);
Route::apiResource('course-teachers', CourseTeacherController::class);
Route::apiResource('teachers', TeacherController::class);
