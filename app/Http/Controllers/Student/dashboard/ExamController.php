<?php

namespace App\Http\Controllers\Student\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Interface\Student\Exams\ExamsRepositoryInterface;
class ExamController extends Controller
{
  protected $exam;

  public function __construct(ExamsRepositoryInterface $exam){
    return $this->exam=$exam;
  }
    public function index()
    {
        return $this->exam->index();
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
    public function show( $quizze_id)
    {
        return $this->exam->show($quizze_id);

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
