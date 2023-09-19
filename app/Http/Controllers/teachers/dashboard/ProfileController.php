<?php

namespace App\Http\Controllers\teachers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\teachers;

class ProfileController extends Controller
{
    public function edit_profile(){
        $information=teachers::findOrFail(auth()->user()->id);
        return view('pages.teachers.dashboard.teacher_profile',compact('information'));
    }

    public function update_profile(Request $request,$id){
         $information=teachers::findOrFail(auth()->user()->id);
         if(!empty($request->password)){
            $information->Name=['ar'=>$request->Name_ar,'en'=>$request->Name_en];

            $information->password=$request->password;
            $information->save();
         }else{
            $information->Name=['ar'=>$request->Name_ar,'en'=>$request->Name_en];
            $information->save();

         }
         session()->flash('edit',trans('messages.Update'));
         return redirect()->route('teacher_dashboard');
        // return view('pages.teachers.dashboard.teacher_profile',compact('information'));
    }
}
