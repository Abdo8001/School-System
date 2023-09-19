<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Models\genders;
//use App\Models\Grade;
use App\Models\Classroom;
use App\Models\sections;
use App\Models\Nationalitie;
use App\Models\my__parents;
use App\Models\student_account;
use App\Models\StudentsAttendance;
use App\Models\Student;
use App\Models\teachers;
use App\Models\feeInvoice;
use App\Http\Controllers\teachers\dashboard\StudentController;
use App\Http\Controllers\teachers\dashboard\QuizzeController;
use App\Http\Controllers\teachers\dashboard\QuestionController;
use App\Http\Controllers\teachers\dashboard\OnlineZoomController;
use App\Http\Controllers\teachers\dashboard\ProfileController;

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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {
     //   dd('teachers test');
     $ids=teachers::findOrFail(auth()->user()->id)->sections()->pluck('section_id');
      $count['of_teaching_section']=$ids->count();
      $count['student_at_section']=Student::whereIn('section_id',$ids)->count();

     $students=Student::latest()->take(5)->get();
     $teachers=teachers::latest()->take(5)->get();
     $parents=my__parents::latest()->take(5)->get();
     $invoices=feeInvoice::latest()->take(5)->get();

     return view('pages.teachers.dashboard.teacher',['count'=>$count,'students'=>$students,'teachers'=>$teachers,'invoices'=>$invoices,'parents'=>$parents]);
    })->name('teacher_dashboard');
    Route::get('/teacher/dashboard/students', [StudentController::class,'index'])->name('student_at.all');
    Route::get('/sectionOfstudent',[StudentController::class,'sections'])->name('SectionOfStudent');
    Route::post('/attendaning',[StudentController::class,'attendaning'])->name('attendaning');
    Route::post('/edit_attendaning',[StudentController::class,'Edit_Attendaning'])->name('Edit_Attendaning');
    Route::post('/find_attendance',[StudentController::class,'FindReport'])->name('find_attendance');
    Route::get('/attendance_report',[StudentController::class,'AttendanceReport'])->name('attendance.report');
    //Route::resource('Classrooms',ClassroomController::class);
    Route::resource('quizzes',QuizzeController::class);
    Route::resource('questions',QuestionController::class);
    Route::resource('ZoomMeetings',OnlineZoomController::class);
    Route::get('quizzes-classes/{id}',[QuizzeController::class,'getClasses']);
    Route::get('profile',[ProfileController::class,'edit_profile'])->name('edit_profile');
    Route::post('profile/{id}',[ProfileController::class,'update_profile'])->name('update_profile');
    Route::get('quizzes-Get_Sections/{id}',[QuizzeController::class,'getAllSections']);
    Route::get('show_student/{id}',[QuizzeController::class,'show_tested'])->name('show_tested_student');
    Route::post('repeat/{id}',[QuizzeController::class,'repeat_test'])->name('repeat_test');


});
