<?php

namespace App\Http\Controllers\Classrooms;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Classroom;
use App\Http\Requests\StoreClassroom;

use Illuminate\Http\Request;

class ClassroomController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
     $grades=Grade::all();
     $classes=Classroom::all();
     return view('pages.My_Classes.my_class',['grades'=>$grades,'classes'=>$classes]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreClassroom $request)
  {
    // dd($request);
    // $this->validate($request,[
    //     'List_Classes.*.Name'=>'required||unique:Classrooms,calss_name',
    //     'List_Classes.*.Name_class_en'=>'required',
    // ],[
    //     'List_Classes.*.Name.required'=>trans('validation.required'),
    //     'List_Classes.*.Name_class_en.required'=>trans('validation.required')
    // ]);

   try {
        $listOfClasses=$request->List_Classes;

        foreach($listOfClasses as $class){

         $Myclasses=new Classroom();
         $Myclasses->calss_name=['ar'=>$class['Name'],'en'=>$class['Name_class_en']];
         $Myclasses->grade_id=$class['grade_id'];
         $Myclasses->save();
        }
        session()->flash('add',trans('My_Classes_trans.add_class'));
        return redirect()->route('Classrooms.index');

   }
   catch (Exception $e){
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request)
  {
    $this->validate($request,[
        'Name'=>'required',
        'Name_class_en'=>'required',
    ],[
        'Name.required'=>trans('validation.required'),
        'Name_class_en.required'=>trans('validation.required')
    ]);
    try{
        $id=$request->class_id;
        Classroom::where('id',$id)->update([
            'calss_name'=>['ar'=>$request->Name,'en'=>$request->Name_class_en],
            'grade_id'=>$request->Grade_id,
        ]);
        session()->flash('edit',trans('messages.Update'));
        return redirect()->route('Classrooms.index');



    }  catch (Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    Classroom::where('id',$id)->delete();
    session()->flash('edit',trans('messages.Delete'));
    return redirect()->route('Classrooms.index');

  }
 public function search(Request $request){
  //  dd($request);
       $grades=Grade::all();
    $classes=Classroom::select('*')->where('grade_id','=',$request->grade_id)->get();
// dd($classes);
return view('pages.My_Classes.my_class',compact('grades'))->withDetails($classes);
    // return redirect()->route('Classrooms.index',['grades'=>$grades,'classesD'=>$classes]);
    // // ->withDetails($classes)

 }
 public function delete_all(Request $request){
    $AllClasses=explode(',',$request->delete_all_id);
    Classroom::whereIn('id',$AllClasses)->delete();
    session()->flash('delete',trans('messages.Delete'));
    return redirect()->route('Classrooms.index');
}
}

?>
