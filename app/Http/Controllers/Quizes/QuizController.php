<?php

namespace App\Http\Controllers\Quizes;
use App\Http\Controllers\Controller;

use App\Models\Quiz;
use App\Interface\Quizz\QuizesRepositoryInterface;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    protected $Quize ;




    public function __construct(QuizesRepositoryInterface $Quize){
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
    public function show(Quiz $quiz)
    {
        //
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
}
