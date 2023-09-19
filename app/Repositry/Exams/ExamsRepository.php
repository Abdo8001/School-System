<?php
namespace App\Repositry\Exams;
use App\Models\Exams;
use App\Models\Grade;
use  App\Interface\Exams\ExamsRepositoryInterface;






class ExamsRepository    implements ExamsRepositoryInterface
{
    public function index(){

     $exams=Exams::get();
     return view('pages.Exams.index',compact('exams'));

    }
    public function create(){
        $grades=Grade::all();
        return view('pages.Exams.create',compact('grades'));

    }
    public function show($id){
        //
    }

    public function edit($id){
        $exam=Exams::findOrFail($id);
        return view('pages.Exams.edit',compact('exam'));
    }

    public function store( $request){
        try{
            $exam= new Exams();
            $exam->name=['ar'=>$request->Name_ar,'en'=>$request->Name_en];
            $exam->term=$request->term;
            $exam->academic_year=$request->academic_year;
            $exam->save();
            session()->flash('add',trans('messages.success'));
             return redirect()->route('Exams.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request){
        try{
            $exam=Exams::findOrFail($request->id);
            $exam->name=['ar'=>$request->Name_ar,'en'=>$request->Name_en];
            $exam->term=$request->term;
            $exam->academic_year=$request->academic_year;
            $exam->save();
            session()->flash('edit',trans('messages.Update'));
             return redirect()->route('Exams.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request){
        Exams::destroy($request->id);
        session()->flash('delete',trans('messages.Delete'));
        return redirect()->route('Exams.index');
    }

}
