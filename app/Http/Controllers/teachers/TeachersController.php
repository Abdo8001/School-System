<?php

namespace App\Http\Controllers\teachers;
use App\Http\Controllers\Controller;
use App\Interface\Teacher\TeacherRepositoryInterface;
use App\Models\teachers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTeachers;

class TeachersController extends Controller
{
    protected $teacher1;
    public function __construct(TeacherRepositoryInterface $teacher){
         $this->teacher1=$teacher;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers=$this->teacher1->GetAllTeachers();
        // return $this->teacher1->GetAllTeachers();
        return view('pages.teachers.Allteachers',compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specilizations=$this->teacher1->GetAllSpecilazation();
        $Genders=$this->teacher1->GetAllGenders();
         return view('pages.teachers.createTeacher',compact('specilizations','Genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeachers $request)
    {

   return $this->teacher1->Create_Teacher($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(teachers $teachers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $teachersEdit= $this->teacher1->FindById($id);
        // dd($teachersEdit);
        $specilizations=$this->teacher1->GetAllSpecilazation();
        $Genders=$this->teacher1->GetAllGenders();

        return view('pages.teachers.editTeacher',compact('teachersEdit','specilizations','Genders'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTeachers $request)
    {
        return $this->teacher1->updateTeacher($request);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
       return $this->teacher1->deleteTeacher($request->id);
    }
}
