<?php

namespace App\Http\Controllers\teachers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Interface\Teacher\TeacherDashboard\QuizzeDashboardRepositryInterface;

class QuizzeController extends Controller
{
    protected $Quize ;




    public function __construct(QuizzeDashboardRepositryInterface $Quize){
        return $this->Quize=$Quize;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Quize->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Quize->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        return $this->Quize->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Quize->show($id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return $this->Quize->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Quize->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Request $request)
    {
        return $this->Quize->destroy($request);
    }
    public function getClasses($id) {
        return $this->Quize->getClasses($id);
    }
    public function getAllSections($id) {

        return $this->Quize->getAllSections($id);
    }
      public function show_tested($id){
        return $this->Quize->show_tested($id);

      }
      public function repeat_test(Request $request,$id){
        return $this->Quize->repeat_test($request,$id);

      }
}
