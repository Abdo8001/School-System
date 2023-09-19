<?php

namespace App\Http\Controllers\Student;
 use App\Http\Controllers\Controller;
use App\Models\StudentsAttendance;
use Illuminate\Http\Request;
use  App\Interface\Attendance\AttendanceRepositoryInterface;

class StudentsAttendanceController extends Controller
{
    protected $Attendance;



    public function __construct(AttendanceRepositoryInterface $Attendance){
        return $this->Attendance=$Attendance;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Attendance->index();

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
        return $this->Attendance->store($request);

    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        return $this->Attendance->show($id);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return $this->Attendance->edit($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Attendance->update($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Attendance->destroy($request);

    }
}
