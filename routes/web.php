<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth'])->group(function (){
    Route::get('/lecturer/create', [LecturerController::class, 'create'])->name('lecturer.create');
    Route::post('/lecturer', [LecturerController::class, 'store'])->name('lecturer.store');

    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/course', [CourseController::class, 'store'])->name('course.store');

    Route::get('/hall/create', [HallController::class, 'create'])->name('hall.create');
    Route::post('/hall', [HallController::class, 'store'])->name('hall.store');

    Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::post('/schedule/check', [ScheduleController::class, 'doesSimilarScheduleExist'])->name('schedule.check');
});
