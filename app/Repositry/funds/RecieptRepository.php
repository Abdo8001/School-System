<?php
namespace App\Repositry\funds;
use App\Interface\funds\RecieptRepositoryInterface;
use App\Models\fee;
use App\Models\Grade;
use App\Models\student;
use App\Models\feeInvoice;
use App\Models\student_account;
use App\Models\ReceiptStudents;
use App\Models\FundAccounts;

use Illuminate\Support\Facades\DB;

class  RecieptRepository implements RecieptRepositoryInterface {


    // show all fees
    public function index (){
        $receipt_students=ReceiptStudents::all();
        return view('pages.Receipt.index',compact('receipt_students'));
    }

      // go to add receipts page
      public function GoToAddReceipts($id){
        $student_id=student::findOrFail($id);
        return view('pages.Receipt.add',compact('student_id'));
      }
    // go to add fees page
    public function AddFees(){
        //
    }

    // create a fee function
    public function CreateReceipt($request){
        DB::beginTransaction();

        try{
                     //insert at ReceiptStudents  table

            $student_Receipt=new ReceiptStudents();
            $student_Receipt->Debit =$request->Debit;
            $student_Receipt->date =date('Y-m-d');
            $student_Receipt->description =$request->description;
            $student_Receipt->student_id =$request->student_id;
            $student_Receipt->save();

         //insert at FundAccounts  table
            $fund= new FundAccounts();
          $fund->date =date('Y-m-d');
          $fund-> receipt_id=$student_Receipt->id;
          $fund->Debit =$request->Debit;
          $fund->description =$request->description;
          $fund->save();
                   //insert at student_account  table
          $student_acount=new student_account();
          $student_acount->date =date('Y-m-d');
          $student_acount->description =$request->description;
          $student_acount->type ='Receipt';
          $student_acount->Debit =$request->Debit;
          $student_acount->credit =0.00;
          $student_acount->receipt_id =$student_Receipt->id;
          $student_acount->student_id =$request->student_id;
          $student_acount->save();
         DB::commit();

   session()->flash('add',trans('messages.success'));
   return redirect()->route('receipts.index');
}catch (\Exception $e) {

    DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }
  // update an existing fee
  public function EditReceipt($id){
    $receipt_student = ReceiptStudents::findorfail($id);
    return view('pages.Receipt.edit',compact('receipt_student'));
  }
// update an existing fee
public function UpdateReceipt($request){

    DB::beginTransaction();

    try{
                 //insert at ReceiptStudents  table

        $student_Receipt= ReceiptStudents::findOrFail($request->id);
        $student_Receipt->Debit =$request->Debit;
        $student_Receipt->date =date('Y-m-d');
        $student_Receipt->description =$request->description;
        $student_Receipt->student_id =$request->student_id;
        $student_Receipt->save();

     //insert at FundAccounts  table
        $fund=  FundAccounts::where('receipt_id',$request->id)->first();
      $fund->date =date('Y-m-d');
      $fund-> receipt_id=$student_Receipt->id;
      $fund->Debit =$request->Debit;
      $fund->description =$request->description;
      $fund->save();
               //insert at student_account  table
      $student_acount= student_account::where('receipt_id',$request->id)->first();
      $student_acount->date =date('Y-m-d');
      $student_acount->description =$request->description;
      $student_acount->type ='Receipt';
      $student_acount->Debit =$request->Debit;
      $student_acount->credit =0.00;
      $student_acount->receipt_id =$student_Receipt->id;
      $student_acount->student_id =$request->student_id;
      $student_acount->save();
     DB::commit();

session()->flash('add',trans('messages.success'));
return redirect()->route('receipts.index');
}catch (\Exception $e) {

DB::rollback();
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}
}
    // delete afee
    public function deletereceipt($request){
        try {
            ReceiptStudents::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
