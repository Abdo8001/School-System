<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Student\dashboard\ExamController;
use App\Http\Controllers\Student\dashboard\ProfileController;

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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:student']
    ], function () {

    //==============================dashboard============================
    Route::get('/student/dashboard', function () {
        return view('pages.student.dashboard');
    })->name('dashboard.Students');
  Route::resource('student_exam', ExamController::class);
  Route::resource('StudentProfile', ProfileController::class);
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
