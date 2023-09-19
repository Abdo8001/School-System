<?php

namespace App\Http\Controllers\Parents\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Degree;
use Illuminate\Support\Facades\DB;
use App\Models\genders;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\sections;
use App\Models\Nationalitie;
use App\Models\my__parents;
use App\Models\student_account;
use App\Models\StudentsAttendance;
use App\Models\teachers;
use App\Models\feeInvoice;
use App\Models\ReceiptStudents;
class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $students=Student::where('parent_id',auth()->user()->id)->get();
      return view('pages.parent.children.index',compact('students'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {

        $student=Student::findOrFail($id);
           if($student->parent_id !==auth()->user()->id){
            session()->flash('wrong','يوجد خطا في كود الطالب');
            return redirect()->route('children.index');

           }
            $degrees=Degree::where('student_id',$id)->get();

        if ($degrees->isEmpty()) {
            session()->flash('noresult','لا توجد نتائج لهذا الطالب');
            return redirect()->route('children.index');
        }
            return view('pages.parent.degrees.degrees',compact('degrees'));

    }

    /**
     * Show the form for editing the specified resource.
     */
   public function childrenAttendance(){
    $students=Student::where('parent_id',auth()->user()->id)->get();
    return view('pages.parent.Attendance.index',compact('students'));

   }
   public function findAttendance(Request $request){
      //  dd($request);
      $request->validate([
        'from' => 'required|date|date_format:Y-m-d',
        'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
    ], [
        'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
        'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
    ]);
    $ids=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
    $students=Student::whereIn('section_id',$ids)->get();
    if($request->student_id==0){
        $Students=StudentsAttendance::whereBetween('attendence_date',[$request->from,$request->to])->get();
        return view('pages.parent.Attendance.index',compact('students','Students'));
    }else {
        $Students=StudentsAttendance::whereBetween('attendence_date',[$request->from,$request->to])->where('student_id',$request->student_id)->get();

        return view('pages.parent.Attendance.index',compact('students','Students'));

    }

   }

   public function fees(){
    $students_ids = Student::where('parent_id', auth()->user()->id)->pluck('id');
    $Fee_invoices = feeInvoice::whereIn('student_id',$students_ids)->get();
    return view('pages.parent.fees.index', compact('Fee_invoices'));

}

public function receiptStudent($id){

    $student = Student::findorFail($id);
    if ($student->parent_id !== auth()->user()->id) {
        session()->flash('wrong','يوجد خطا في كود الطالب');
        return redirect()->route('sons.fees');
    }

    $receipt_students = ReceiptStudents::where('student_id',$id)->get();

    if ($receipt_students->isEmpty()) {
        session()->flash('nopayments','لا توجد مدفوعات لهذا الطالب');
        return redirect()->route('sons.fees');
    }
    return view('pages.parent.Receipt.index', compact('receipt_students'));

}
public function edit_profile(){
    $information=my__parents::findOrFail(auth()->user()->id);
    return view('pages.parent.profile',compact('information'));
}

public function update_profile(Request $request,$id){
     $information=my__parents::findOrFail(auth()->user()->id);
     if(!empty($request->password)){
        $information->Name_Father=['ar'=>$request->Name_ar,'en'=>$request->Name_en];

        $information->password=$request->password;
        $information->save();
     }else{
        $information->Name_Father=['ar'=>$request->Name_ar,'en'=>$request->Name_en];
        $information->save();

     }
     session()->flash('edit',trans('messages.Update'));
     return redirect()->route('parent.dashboard');
    // return view('pages.teachers.dashboard.teacher_profile',compact('information'));
}


}
