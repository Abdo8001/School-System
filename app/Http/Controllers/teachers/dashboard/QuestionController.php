<?php

namespace App\Http\Controllers\teachers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Interface\Teacher\TeacherDashboard\QuestionDashboardRepositryInterface;

class QuestionController extends Controller
{
    protected $question;


    public function __construct(QuestionDashboardRepositryInterface $question){
      return $this->question=$question;
    }
    public function index()
    {
        return $this->question->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->question->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        return $this->question->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->question->show($id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return $this->question->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        return $this->question->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Request $request)
    {
        return $this->question->destroy($request);
    }
}
