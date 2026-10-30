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
    if (auth()->check() && auth()->user()->role === 'aprendiz') {
        return redirect()->route('apprentice.dashboard');
    }

    return view('home');
})->name('home');

Route::get('/areas', [AreaController::class, 'index'])->name('api.v1.areas.index');
Route::get('/areas/create', [AreaController::class, 'create'])->name('api.v1.area.create');
Route::post('/areas', [AreaController::class, 'store'])->name('api.v1.areas.store');
Route::get('/areas/{area}', [AreaController::class, 'show'])->name('api.v1.areas.show');
Route::put('/areas/{area}', [AreaController::class, 'update'])->name('api.v1.areas.update');
Route::delete('/areas/{area}', [AreaController::class, 'destroy'])->name('api.v1.areas.destroy');

Route::get('/computers', [ComputerController::class, 'index'])->name('api.v1.computers.index');
Route::get('/computers/create', [ComputerController::class, 'create'])->name('api.v1.computer.create');
Route::post('/computers', [ComputerController::class, 'store'])->name('api.v1.computers.store');
Route::get('/computers/{computer}', [ComputerController::class, 'show'])->name('api.v1.computers.show');
Route::put('/computers/{computer}', [ComputerController::class, 'update'])->name('api.v1.computers.update');
Route::delete('/computers/{computer}', [ComputerController::class, 'destroy'])->name('api.v1.computers.destroy');

Route::get('/training_centers', [TrainingCenterController::class, 'index'])->name('api.v1.training_centers.index');
Route::get('/training_centers/create', [TrainingCenterController::class, 'create'])->name('api.v1.training_center.create');
Route::post('/training_centers', [TrainingCenterController::class, 'store'])->name('api.v1.training_centers.store');
Route::get('/training_centers/{trainingCenter}', [TrainingCenterController::class, 'show'])->name('api.v1.training_centers.show');
Route::put('/training_centers/{trainingCenter}', [TrainingCenterController::class, 'update'])->name('api.v1.training_centers.update');
Route::delete('/training_centers/{trainingCenter}', [TrainingCenterController::class, 'destroy'])->name('api.v1.training_centers.destroy');

Route::get('/apprentices', [ApprenticeController::class, 'index'])->name('api.v1.apprentices.index');
Route::get('/apprentices/create', [ApprenticeController::class, 'create'])->name('api.v1.apprentice.create');
Route::post('/apprentices', [ApprenticeController::class, 'store'])->name('api.v1.apprentices.store');
Route::get('/apprentices/{apprentice}', [ApprenticeController::class, 'show'])->name('api.v1.apprentices.show');
Route::put('/apprentices/{apprentice}', [ApprenticeController::class, 'update'])->name('api.v1.apprentices.update');
Route::delete('/apprentices/{apprentice}', [ApprenticeController::class, 'destroy'])->name('api.v1.apprentices.destroy');

Route::get('/courses', [CourseController::class, 'index'])->name('api.v1.courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('api.v1.course.create');
Route::post('/courses', [CourseController::class, 'store'])->name('api.v1.courses.store');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('api.v1.courses.show');
Route::put('/courses/{course}', [CourseController::class, 'update'])->name('api.v1.courses.update');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('api.v1.courses.destroy');

Route::get('/course-teachers', [CourseTeacherController::class, 'index'])->name('api.v1.course_teachers.index');
Route::get('/course-teachers/create', [CourseTeacherController::class, 'create'])->name('api.v1.course_teacher.create');
Route::post('/course-teachers', [CourseTeacherController::class, 'store'])->name('api.v1.course_teachers.store');
Route::get('/course-teachers/{course_teacher}', [CourseTeacherController::class, 'show'])->name('api.v1.course_teachers.show');
Route::put('/course-teachers/{course_teacher}', [CourseTeacherController::class, 'update'])->name('api.v1.course_teachers.update');
Route::delete('/course-teachers/{course_teacher}', [CourseTeacherController::class, 'destroy'])->name('api.v1.course_teachers.destroy');

Route::get('/teachers', [TeacherController::class, 'index'])->name('api.v1.teachers.index');
Route::get('/teachers/create', [TeacherController::class, 'create'])->name('api.v1.teacher.create');
Route::post('/teachers', [TeacherController::class, 'store'])->name('api.v1.teachers.store');
Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])->name('api.v1.teachers.show');
Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('api.v1.teachers.update');
Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('api.v1.teachers.destroy');
