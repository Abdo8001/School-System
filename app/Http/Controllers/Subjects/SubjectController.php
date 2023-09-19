<?php

namespace App\Http\Controllers\Subjects;
use App\Http\Controllers\Controller;

use App\Models\Subject;
use App\Interface\Subjects\SubjectsRepositoryInterface;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $subjects;



    public function __construct(SubjectsRepositoryInterface $subjects){

        return $this->subjects=$subjects;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->subjects->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->subjects->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->subjects->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return $this->subjects->edit($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->subjects->update($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Request $request)
    {
        return $this->subjects->destroy($request);


    }
}
