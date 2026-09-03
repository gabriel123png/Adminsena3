<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\TrainingCenterController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', function () {

    return view('home');

})->name('home');

Route::resource('areas', AreaController::class);
Route::resource('training_centers', TrainingCenterController::class);
Route::resource('computers', ComputerController::class);
Route::resource('courses', CourseController::class);
Route::resource('teachers', TeacherController::class);