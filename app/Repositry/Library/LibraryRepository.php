<?php
namespace App\Repositry\Library;
use App\Interface\Library\LibraryRepositoryInterface;


use App\Models\Library;
use App\Models\teachers;
use App\Models\Nationalitie;
use App\Models\Grade;
use App\Models\sections;
use App\Models\Student;
use App\Http\Traits\FileUploadTriat;



class LibraryRepository implements LibraryRepositoryInterface
{
    use FileUploadTriat;
    public function index(){
        $libraries=Library::all();
        return view('pages.library.index',compact('libraries'));
    }
    public function create(){
        $grades=Grade::all();
        return view('pages.library.create',compact('grades'));
    }
    public function show($id){
        //
    }

    public function edit($id){
        $book=Library::findOrFail($id);
        $grades=Grade::all();

        return view('pages.library.edit',compact('book','grades'));
    }

    public function store( $request){
       // dd($request);
        try{
            $books=new Library();
            $books->title = ['ar'=>$request->title_ar,'en'=>$request->title_en];
            $books->file_name =  $request->file('file_name')->getClientOriginalName();
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = 1;
            $books->save();
           // if(!empty($request->file))
         $file=$this->uploadFile($request,'file_name','library');
         session()->flash('add',trans('messages.success'));
         return  redirect()->route('library.index');
            } catch (\Exception $e){

                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
    }

    public function update($request){
        try{
           if($request->hasfile('file_name')){
            $books= Library::findOrFail($request->id);
            $books->title = ['ar'=>$request->title_ar,'en'=>$request->title_en];
            $books->file_name =  $request->file('file_name')->getClientOriginalName();
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = 1;
            $books->save();
          // if(!empty($request->file))
          $file=$this->uploadFile($request,'file_name','library');
          session()->flash('edit',trans('messages.Update'));
          return  redirect()->route('library.index');
           }else{
            $books= Library::findOrFail($request->id);
            $books->title = ['ar'=>$request->title_ar,'en'=>$request->title_en];
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = 1;
            $books->save();
          // if(!empty($request->file))
          session()->flash('edit',trans('messages.Update'));
          return  redirect()->route('library.index');
           }

            } catch (\Exception $e){

                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
    }

    public function destroy($request){
       $this->deleteUplodedFile($request->file('file_name'));
        Library::findOrFail($request->id)->delete();
        session()->flash('delete',trans('messages.Delete'));
        return  redirect()->route('library.index');

    }
    public function download($file){

        return  response()->download( public_path('attachments/library/'.$file));
    }


}
