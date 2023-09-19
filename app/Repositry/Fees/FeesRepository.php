<?php
namespace App\Repositry\Fees;
use App\Models\fee;
use App\Models\Grade;

use  App\Interface\Fees\FeesRepositoryInterface;

class FeesRepository implements FeesRepositoryInterface {

    // show all fees
    public function index (){
        $fees=fee::all();
        return view('pages.Fees.index',compact('fees'));
    }

    // go to add fees page
    public function AddFees(){
        $grades=Grade::all();
        return view('pages.Fees.add',compact('grades'));

    }

    // create a fee function
    public function CreateFee($request){
       // dd($request);
        try{
            $fee=new fee();
            $fee->title=['ar'=>$request->title_ar,'en'=>$request->title_en];
            $fee->amount=$request->amount;
            $fee->Grade_id=$request->Grade_id;
            $fee->Classroom_id=$request->Classroom_id;
            $fee->Fee_type=$request->Fee_type;
            $fee->year=$request->year;
            $fee->description=$request->description;
            $fee->save();
            toastr()->success(trans('messages.success'));

            return  redirect()->route('fees.index');
        }catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // update an existing fee
    public function EditFee($id){
        $fee=fee::where('id',$id)->first();
        $Grades=Grade::all();

        return view('pages.Fees.edit',compact('fee','Grades'));
    }
    // update an existing fee
    public function UpdateFee($request){
        try {
            $fees = fee::findorfail($request->id);
            $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fees->amount  =$request->amount;
            $fees->Grade_id  =$request->Grade_id;
            $fees->Classroom_id  =$request->Classroom_id;
            $fees->description  =$request->description;
            $fees->Fee_type  =$request->Fee_type;
            $fees->year  =$request->year;
            $fees->save();
            session()->flash('edit',trans('messages.Update'));
            return redirect()->route('fees.index');
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // delete afee
    public function deleteFee($request){

        try {
            $fee = fee::findorfail($request->id);
           $fee->delete();
            $fees->save();
            session()->flash('delete',trans('messages.Delete'));
            return redirect()->route('fees.index');
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


}
