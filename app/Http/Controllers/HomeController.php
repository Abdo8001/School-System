<?php

namespace App\Http\Controllers;
use App\Models\genders;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\sections;
use App\Models\Nationalitie;
use App\Models\my__parents;
use App\Models\student_account;
use App\Models\StudentsAttendance;
use App\Models\Student;
use App\Models\teachers;
use App\Models\feeInvoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.selection');
    }
    public function dashbord()
    {
        $count['student']=Student::count();
        $count['teachers']=teachers::count();
        $count['perants']=my__parents::count();
        $count['sections']=sections::count();
        $students=Student::latest()->take(5)->get();
        $teachers=teachers::latest()->take(5)->get();
        $parents=my__parents::latest()->take(5)->get();
        $invoices=feeInvoice::latest()->take(5)->get();

        return view('dashboard',['count'=>$count,'students'=>$students,'teachers'=>$teachers,'invoices'=>$invoices,'parents'=>$parents]);
    }
}
