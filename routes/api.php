<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Api\ComputerController;
use App\Http\Controllers\Api\TrainingCenterController;
use App\Http\Controllers\Api\ApprenticeController ;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CourseTeacherController ;
use App\Http\Controllers\Api\TeacherController ;
use App\Http\Controllers\Api\AuthController;
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
Route::apiResource('computers', ApiComputerController::class);
Route::apiResource('training_centers', ApiTrainingCenterController::class);
Route::apiResource('apprentices', ApiApprenticeController::class);
Route::apiResource('courses', ApiCourseController::class);
Route::apiResource('course-teachers', ApiCourseTeacherController::class);
Route::apiResource('teachers', ApiTeacherController::class);

Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas (Requieren enviar el Token Bearer)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});