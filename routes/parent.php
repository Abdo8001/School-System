<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Grades\GradeController;
use App\Models\Student;
use App\Http\Controllers\Parents\dashboard\ChildrenController;

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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ], function () {

    //==============================dashboard============================
    Route::get('/parent/dashboard', function () {
        $sons=Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parent.dashboard',compact('sons'));
    })->name('parent.dashboard');
    Route::resource('children', ChildrenController::class);
    Route::get('childrenAttendance', [ChildrenController::class,'childrenAttendance'])->name('childrenAttendance');
    Route::get('StudentFees', [ChildrenController::class,'fees'])->name('StudentFees');
    Route::get('ParentProfile', [ChildrenController::class,'edit_profile'])->name('ParentProfile');
    Route::post('UpdateParent/{id}', [ChildrenController::class,'update_profile'])->name('UpdateParent');
    Route::get('receiptStudent/{id}', [ChildrenController::class,'receiptStudent'])->name('receiptStudent');
    Route::post('findAttendance', [ChildrenController::class,'findAttendance'])->name('findAttendance');
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
