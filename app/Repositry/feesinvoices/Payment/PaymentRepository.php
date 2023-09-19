<?php
namespace App\Repositry\feesinvoices\Payment;
use  App\Interface\feesinvoices\Payment\PaymentRepositoryInterface;

use App\Models\fee;
use App\Models\Grade;
use App\Models\student;
use App\Models\feeInvoice;
use App\Models\processing_fee;
use App\Models\student_account;
use App\Models\PaymentStudents;
use App\Models\FundAccounts;

use Illuminate\Support\Facades\DB;





class  PaymentRepository implements PaymentRepositoryInterface
{
    public function index(){
        $payment_students=PaymentStudents::all();
        return view('pages.Payment.index',compact('payment_students'));
    }

    public function show($id){
        $student=student::findOrFail($id);
        return view('pages.Payment.add',compact('student'));
    }

    public function edit($id){
        $payment=PaymentStudents::findOrFail($id);
        return view('pages.Payment.edit',compact('payment'));
    }

    public function store( $request){
        DB::beginTransaction();
        try{
            // saving at PaymentStudents table
            $payment=new PaymentStudents();
            $payment->date=date('Y-m-d');
            $payment->amount=$request->Debit;
            $payment->student_id=$request->student_id;
            $payment->description=$request->description;
            $payment->save();
            // save at student_account table
            $student_acount=new student_account();
            $student_acount->date=date('Y-m-d');
            $student_acount->type='payment';

            $student_acount->student_id=$request->student_id;
            $student_acount->description=$request->description;
            $student_acount->payment_id=$payment->id;
            $student_acount->credit=0.00;
            $student_acount->Debit=$request->Debit;
            $student_acount->save();
          // save at FundAccounts table
          $funds_acount=new FundAccounts();
          $funds_acount->date=date('Y-m-d');
          $funds_acount->payment_id=$payment->id;
          $funds_acount->Debit=0.00;
          $funds_acount->credit=$request->Debit;
          $funds_acount->description=$request->description;
          $funds_acount->save();
DB::commit();

          session()->flash('add',trans('messages.success'));
          return redirect()->route('payments.index');
       }catch (\Exception $e) {

           DB::rollback();
               return redirect()->back()->withErrors(['error' => $e->getMessage()]);
           }
    }
    public function update($request){
// dd($request);
        DB::beginTransaction();
        try{
            // saving at PaymentStudents table
            $payment= PaymentStudents::findOrFail($request->id);
            $payment->date=date('Y-m-d');
            $payment->amount=$request->Debit;
            $payment->student_id=$request->student_id;
            $payment->description=$request->description;
            $payment->save();
            // save at student_account table
            $student_acount= student_account::where('payment_id',$request->id)->first();
            $student_acount->date=date('Y-m-d');
            $student_acount->type='payment';

            $student_acount->student_id=$request->student_id;
            $student_acount->description=$request->description;
            $student_acount->payment_id=$payment->id;
            $student_acount->credit=0.00;
            $student_acount->Debit=$request->Debit;
            $student_acount->save();
          // save at FundAccounts table
          $funds_acount= FundAccounts::where('payment_id',$request->id)->first();
        //   dd($funds_acount);
          $funds_acount->date=date('Y-m-d');
          $funds_acount->payment_id=$payment->id;
          $funds_acount->Debit=0.00;
          $funds_acount->credit=$request->Debit;
          $funds_acount->description=$request->description;
          $funds_acount->save();
DB::commit();

          session()->flash('edit',trans('messages.Update'));
          return redirect()->route('payments.index');
       }catch (\Exception $e) {

           DB::rollback();
               return redirect()->back()->withErrors(['error' => $e->getMessage()]);
           }
    }

    public function destroy($request){
        try {
            PaymentStudents::destroy($request->id);
           session()->flash('delete',trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
