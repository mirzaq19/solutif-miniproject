<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TakeCourseController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class, 'index'])->middleware('guest')->name('login');
Route::post('login', [AuthController::class, 'login'])->name('auth');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class,'index'])->name('dashboard.index');
        Route::get('report/{student}/download', [StudentController::class,'report'])->name('dashboard.report');
        Route::middleware('admin')->group(function (){
            Route::resource('student', StudentController::class);
            Route::resource('course', CourseController::class);
            Route::prefix('student')->group(function () {
                Route::get('{student}/report', [StudentController::class, 'report'])->name('student.report');
                Route::post('{student}/take-course', [TakeCourseController::class, 'store'])->name('student.take-course.store');
                Route::put('{student}/take-course/{course}', [TakeCourseController::class, 'update'])->name('student.take-course.update');
                Route::delete('{student}/take-course/{course}', [TakeCourseController::class, 'destroy'])->name('student.take-course.destroy');
            });
        });
    });
});
