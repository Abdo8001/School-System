<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Interface\Student\StudentGraduted\StudentGraduatedRepositoryInterface;


class GradutedController extends Controller
{

    protected $graduted;

    public function __construct(StudentGraduatedRepositoryInterface $graduted){
          return $this->graduted=$graduted;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->graduted->ShowAll();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->graduted->MakeGradute();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->graduted->MakeStudentGraduted($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->graduted->gradutionRollBack($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->graduted->destroy_student($request);
    }
}
