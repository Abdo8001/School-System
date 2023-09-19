<?php
namespace App\Repositry\feesinvoices\processing;
use  App\Interface\feesinvoices\processing\ProcessingFeeRepositoryInterface;

use App\Models\fee;
use App\Models\Grade;
use App\Models\student;
use App\Models\feeInvoice;
use App\Models\processing_fee;
use App\Models\student_account;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;





class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{
    public function index(){
        $fee_process=processing_fee::all();
        return view('pages.ProcessingFee.index',compact('fee_process'));
    }

    public function show($id){
        $student=student::findOrFail($id);
        return view('pages.ProcessingFee.add',compact('student'));
    }

    public function edit($id){
        $fee_process=processing_fee::findOrFail($id);
        return view('pages.ProcessingFee.edit',compact('fee_process'));
    }

    public function update($request){
        DB::beginTransaction();

        try{
            // save at proceesing_fees table
            $fee_process= processing_fee::findOrFail($request->id);
            $fee_process->date=date('Y-m-d');
            $fee_process->student_id=$request->student_id;
            $fee_process->amount=$request->Debit;
            $fee_process->description=$request->description;
            $fee_process->save();
            // save at student_account table
             $student_account= student_account::where('processing_id',$request->id)->first();
             $student_account->date=date('Y-m-d');
             $student_account->type='ProcessingFee';
             $student_account->student_id=$request->student_id;
             $student_account->description=$request->description;
             $student_account->Debit=0.00;
             $student_account->credit=$request->Debit;
             $student_account->processing_id=$fee_process->id;
             $student_account->save();
             DB::commit();

             session()->flash('add',trans('messages.success'));
             return redirect()->route('processing_fees.index');
          }catch (\Exception $e) {

              DB::rollback();
                  return redirect()->back()->withErrors(['error' => $e->getMessage()]);
              }
    }

    public function store($request){

        try{
            // save at proceesing_fees table
            $fee_process= new processing_fee();
            $fee_process->date=date('Y-m-d');
            $fee_process->student_id=$request->student_id;
            $fee_process->amount=$request->Debit;
            $fee_process->description=$request->description;
            $fee_process->save();
            // save at student_account table
             $student_account=new student_account();
             $student_account->date=date('Y-m-d');
             $student_account->type='ProcessingFee';
             $student_account->student_id=$request->student_id;
             $student_account->description=$request->description;
             $student_account->Debit=0.00;
             $student_account->credit=$request->Debit;
             $student_account->processing_id=$fee_process->id;
             $student_account->save();
             DB::commit();

             session()->flash('edit',trans('messages.Update'));
             return redirect()->route('processing_fees.index');
          }catch (\Exception $e) {

              DB::rollback();
                  return redirect()->back()->withErrors(['error' => $e->getMessage()]);
              }
    }

    public function destroy($request){
        try {
            processing_fee::destroy($request->id);
            session()->flash('delete',trans('messages.Delete'));

            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}

