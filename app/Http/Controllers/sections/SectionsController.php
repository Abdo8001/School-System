<?php

namespace App\Http\Controllers\sections;
use App\Http\Controllers\Controller;
use App\Models\Classroom;


use App\Models\sections;
use App\Models\teachers;
use Illuminate\Http\Request;
use App\Models\Grade;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades=Grade::with(['sections'])->get();
       //  print_r($grades);
       $teachers=teachers::all();

        $list_Grades=Grade::all();

        return view('pages.sections.allSections',compact('grades','list_Grades','teachers'));
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
        //dd($request->teacher_id);
        $this->validate($request,[
            'Name_Section_Ar'=>'required',
            'Name_Section_En'=>'required',
            'Grade_id'=>'required',
            'Class_id'=>'required',

        ],[
            'Name_Section_Ar.required'=>trans('validation.required'),
            'Name_Section_En.required'=>trans('validation.required'),
            'Grade_id.required'=>trans('validation.required'),
            'Grade_id.required'=>trans('validation.required'),

        ]);
       try{
        $Section=new sections();
        $Section->Name_Section=['ar'=>$request->Name_Section_Ar,'en'=>$request->Name_Section_En];
        $Section->Grade_id=$request->Grade_id;
        $Section->Class_id=$request->Class_id;
        $Section->Status = 1;

        $Section->save();
        $Section->teachers()->attach($request->teacher_id);
        session()->flash('add',trans('messages.success'));
        return redirect()->route('Sections.index');
       } catch (Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }

    }

    /**
     * Display the specified resource.
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'Name_Section_Ar'=>'required',
            'Name_Section_En'=>'required',
            'Grade_id'=>'required',
            'Class_id'=>'required',

        ],[
            'Name_Section_Ar.required'=>trans('validation.required'),
            'Name_Section_En.required'=>trans('validation.required'),
            'Grade_id.required'=>trans('validation.required'),
            'Grade_id.required'=>trans('validation.required'),

        ]);
        if(isset($request->Status)){
            $Status=1;

          }else{
            $Status=2;

          }
        try{
            $id=$request->id;
           $section=sections::findOrfail($id);
           $section->Name_Section=['ar'=>$request->Name_Section_Ar,'en'=>$request->Name_Section_En];
           $section->Grade_id=$request->Grade_id;
           $section->Class_id=$request->Class_id;
           $section->Status=$Status;
            // sections::where('id',$id)->update([
            //   'Name_Section'=>['ar'=>$request->Name_Section_Ar,'en'=>$request->Name_Section_En],
            //   'Grade_id'=>$request->Grade_id,
            //   'Class_id'=>$request->Class_id,
            //   'Status'=>$Status,

            // ]);
            if(isset($request->teacher_id)){
              $section->teachers()->sync($request->teacher_id);

            }else{
                $section->teachers()->sync(array());

            }
            session()->flash('edit',trans('messages.Update'));
        return redirect()->route('Sections.index');
        } catch (Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
           }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        sections::findOrFail($request->id)->delete();
        session()->flash('edit',trans('messages.Delete'));
        return redirect()->route('Sections.index');

    }
    // getClasses function
    public function getClasses($id){
        $list_classes=Classroom::where('grade_id',$id)->pluck('calss_name','id');
        return $list_classes;
    }
}
