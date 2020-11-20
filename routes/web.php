<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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

Route::get('/{scheduleType?}', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth'])->group(function (){
    Route::get('/schedule/dashboard/{scheduleType?}', [DashboardController::class, 'index'])->name('schedule.dashboard');
    Route::get('/lecturer/create', [LecturerController::class, 'create'])->name('lecturer.create');
    Route::post('/lecturer', [LecturerController::class, 'store'])->name('lecturer.store');
    Route::get('/lecturer/{lecturer}/edit', [LecturerController::class, 'edit'])->name('lecturer.edit');
    Route::get('/lecturer/showlist', [LecturerController::class, 'showlist'])->name('lecturer.showlist');
    Route::patch('/lecturer/{lecturer}', [LecturerController::class, 'update'])->name('lecturer.update');
    Route::delete('/lecturer/{lecturer}', [LecturerController::class, 'destroy'])->name('lecturer.delete');

    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/course', [CourseController::class, 'store'])->name('course.store');
    Route::get('/course/{course}/edit', [CourseController::class, 'edit'])->name('course.edit');
    Route::get('/course/showlist', [CourseController::class, 'showlist'])->name('course.showlist');
    Route::patch('/course/{course}', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/course/{course}', [CourseController::class, 'destroy'])->name('course.delete');

    Route::get('/hall/create', [HallController::class, 'create'])->name('hall.create');
    Route::post('/hall', [HallController::class, 'store'])->name('hall.store');
    Route::get('/hall/{hall}/edit', [HallController::class, 'edit'])->name('hall.edit');
    Route::get('/hall/showlist', [HallController::class, 'showlist'])->name('hall.showlist');
    Route::patch('/hall/{hall}', [HallController::class, 'update'])->name('hall.update');
    Route::delete('/hall/{hall}', [HallController::class, 'destroy'])->name('hall.delete');

    Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::post('/schedule/check', [ScheduleController::class, 'doesSimilarScheduleExist'])->name('schedule.check');
    Route::get('/schedule/showlist', [ScheduleController::class, 'showlist'])->name('schedule.showlist');
    Route::get('/schedule/{schedule}', [ScheduleController::class, 'show'])->name('schedule.show');
    Route::get('/schedule/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
    Route::patch('/schedule/{schedule}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('/schedule/{schedule}', [ScheduleController::class, 'destroy'])->name('schedule.delete');

    
});
