<?php

namespace App\Http\Controllers\Student\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $information=Student::findOrFail(auth()->user()->id);
        return view('pages.student.dashboard.StudentProfile',compact('information'));
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
        $information=Student::findOrFail(auth()->user()->id);
        if(!empty($request->password)){
           $information->name=['ar'=>$request->Name_ar,'en'=>$request->Name_en];

           $information->password=$request->password;
           $information->save();
        }else{
           $information->name=['ar'=>$request->Name_ar,'en'=>$request->Name_en];
           $information->save();

        }
        session()->flash('edit',trans('messages.Update'));
        return redirect()->route('dashboard.Students');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
