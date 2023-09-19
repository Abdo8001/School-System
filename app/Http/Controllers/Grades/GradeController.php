<?php

namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Http\Requests\StoreGradeRequest;
use App\Models\Classroom;



class GradeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $grades=Grade::all();
   return view('pages.grades.showgrades',['grades'=>$grades]);
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
  public function store(StoreGradeRequest $request)
  {
    try{
        $validate=$request->validated();
        $grade=new Grade();
        $grade->name=['en'=>$request->name_en,'ar'=>$request->name];
        $grade->notes=$request->notes;
        $grade->save();
      //  toastr()->success('Data has been saved successfully!');
        $request->session()->flash('add',trans('messages.success'));
        return redirect()->route('grades.index');

    }
    catch(Exception $e){
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
   try{
    $validate=$request->validate([
        'name'=>'required|unique:grades|max:255',
        'name_en'=>'required|max:255',
        'notes'=>'required',

    ]);
    //dd($request);

    $id=$request->id;
    // $grade = Grade::findOrFail($request->id);
    // $grade->update([
    //   $grade->name=['ar'=>$request->name,'en'=>$request->name_en],
    //   $grade->notes=$request->notes,
    // ]);
    Grade::where('id', $id)->update([
        'name'=>['ar'=>$request->name,'en'=>$request->name_en],
      'notes'=>$request->notes,
      ]);

    session()->flash('edit',trans('messages.Update'));
        return redirect()->route('grades.index');

   }
   catch (Exception $e){
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
       // try{
            // $grade=;
            // $grade->delete();
            $MyClass_id = Classroom::where('Grade_id',$id)->pluck('Grade_id');
        if(count($MyClass_id)==0){
            $grade=Grade::findOrFail($id)->delete();
            session()->flash('delete',trans('messages.Delete'));
            return redirect()->route('grades.index');
        }else{

            session()->flash('warn',trans('grade_trans.delete_Grade_Error'));
            return redirect()->route('grades.index');

        }
            // session()->flash('delete',trans('messages.Delete'));
            // if(Grade::find($id)->classrooms()){


            // }

        //}
        //catch(Exception $e){
         //   return redirect()->back()->withErrors(['error' => $e->getMessage()]);



   // }
}

}

?>
