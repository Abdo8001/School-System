<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use   App\Interface\Student\StudentRepositoryinterface;


use App\Models\Student;
use Illuminate\Http\Request;
class StudentController extends Controller
{

    protected $student;

    /**
     * Display a listing of the resource.
     */

    // constrctor
    public function __construct(StudentRepositoryinterface $student){
      $this->student=$student;
    }
    // constrctor end

    public function index()
    {
        return $this->student->get_student();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return $this->student->createStudent();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
       // dd($request->photos);
        return $this->student->insertStudent($request);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
    return $this->student->show_Student($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return  $this->student->edit_student($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request)
  {
    return    $this->student->update_student($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
    return $this->student->delete_student($request->id);

    }
    // get all sections
    public function getAllSections($id){

        return $this->student->getSections($id);
    }
    // uploadAttachments
    public function uploadAttachments(Request $request){
        // $this->validate($request,[

        // ]);
        //dd($request->photos);
        return $this->student->uplodeImage($request);

    }
    public function DeleteAttachment(Request $request){
        // Delete_attachment
        return $this->student->Delete_attachment($request);
    }
    // download img
    public function download_photo($img_name,$student_id){
         return $this->student->download_img($img_name,$student_id);
    }
}
