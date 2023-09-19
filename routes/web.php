<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\sections\SectionsController;
use App\Http\Controllers\teachers\TeachersController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentsAttendanceController;
use App\Http\Controllers\Student\PromotionsController;
use App\Http\Controllers\Student\GradutedController;
use App\Http\Controllers\Student\OnlineClasseController;
use App\Http\Controllers\fees\FeeController;
use App\Http\Controllers\fees\feeInvoicesController;
use App\Http\Controllers\fees\ReceiptStudentsController;
use App\Http\Controllers\fees\ProcessingFeeController;
use App\Http\Controllers\fees\PaymentStudentsController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Exams\ExamsController;
use App\Http\Controllers\Quizes\QuizController;
use App\Http\Controllers\Quizes\QuestionController;
use App\Http\Controllers\Library\LibraryController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\CalenderController;
use App\Http\Livewire\Calendar;

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

//Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('selection');

// route::group(['middleware'=>['guest']],function(){
// Route::get('/',function(){
//     return view('auth.login');

// });
// });
Route::group(['namespace'=>'Auth'],function () {
    Route::get('/login/{type}',[LoginController::class,'loginForm'])->middleware('guest')->name('login.show');
   Route::post('login',[LoginController::class,'login'])->name('login');
   Route::get('/loguot/{type}',[LoginController::class,'logout'])->name('logout');
});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ], function(){
        Route::get('/dashbord', [HomeController::class, 'dashbord'])->name('dashbord');

    // Route::get('/', function()
    // {
    //     return view('auth.login');
    // });
    //Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    // Route::get('/dashbord/student', function(){

    //     return view('pages.student.dashboard');
    //   });

    Route::resource('grades',GradeController::class);
    Route::resource('Classrooms',ClassroomController::class);
    Route::resource('Sections',SectionsController::class);
    Route::resource('teachers',TeachersController::class);
    Route::resource('students',StudentController::class);
    Route::resource('promotion',PromotionsController::class);
    Route::resource('graduted',GradutedController::class);
    Route::resource('fees',FeeController::class);
    Route::resource('Fees_Invoices',feeInvoicesController::class);
    Route::resource('receipts',ReceiptStudentsController::class);
    Route::resource('processing_fees',ProcessingFeeController::class);
    Route::resource('payments',PaymentStudentsController::class);
    Route::resource('students_Attendance',StudentsAttendanceController::class);
    Route::resource('subjects',SubjectController::class);
    Route::resource('Exams',ExamsController::class);
    Route::resource('quizes',QuizController::class);
    Route::resource('question',QuestionController::class);
    Route::resource('zoom',OnlineClasseController::class);
    Route::resource('library',LibraryController::class);
    Route::resource('setting',SettingController::class);
    Route::post('Filter_Classes',[ClassroomController::class,'search'])->name('Filter_Classes');
    Route::post('delete_all',[ClassroomController::class,'delete_all'])->name('delete_all');
    Route::get('classes/{id}',[SectionsController::class,'getClasses']);
    Route::get('download/{id}',[LibraryController::class,'downloadFile'])->name('download_file');
    Route::get('Get_Sections/{id}',[StudentController::class,'getAllSections']);
    Route::get('download_photo/{student_id}/{img_name}',[StudentController::class,'download_photo']);
    Route::post('uploadAttachments',[StudentController::class,'uploadAttachments'])->name('uploadAttachments');
    Route::Delete('DeleteAttachment',[StudentController::class,'DeleteAttachment'])->name('DeleteAttachment');
    Route::view('add_parent', 'livewire.showparent')->name('add_parent');
    Livewire::component('calendar', Calendar::class);
    Route::get('calendar-event', [CalenderController::class, 'index']);
Route::post('calendar-crud-ajax', [CalenderController::class, 'calendarEvents']);
});
//Livewire::component('calendar', Calendar::class);
Route::get('/test', function () {
    return view('pages.tesr.empty');
});





