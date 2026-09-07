<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\TrainingCenterController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\AuthController;
use App\Models\Apprentice;

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
    if (auth()->check() && auth()->user()->role === 'aprendiz') {
        return redirect()->route('apprentice.dashboard');
    }

    return view('home');
})->name('home');

Route::get('/login', function () {
    return redirect()->route('home');
})->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/aprendiz', function () {
    $apprentice = Apprentice::with(['course', 'computer'])
        ->where('email', auth()->user()->email)
        ->first();

    return view('apprentice.dashboard', compact('apprentice'));
})->middleware(['auth', 'role:aprendiz'])->name('apprentice.dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('areas', AreaController::class);
    Route::resource('training_centers', TrainingCenterController::class);
    Route::resource('computers', ComputerController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('apprentices', ApprenticeController::class);
});