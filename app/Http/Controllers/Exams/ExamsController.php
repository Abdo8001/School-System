<?php

namespace App\Http\Controllers\Exams;
use App\Http\Controllers\Controller;
use  App\Interface\Exams\ExamsRepositoryInterface;

use App\Models\Exams;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    protected $Exams;


    public function __construct(ExamsRepositoryInterface $Exams){

        return $this->Exams=$Exams;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Exams->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Exams->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Exams->store($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(Exams $exams)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return $this->Exams->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Exams->update($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Request $request)
    {
        return $this->Exams->destroy($request);

    }
}
