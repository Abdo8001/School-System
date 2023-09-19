<?php
namespace App\Repositry\feesinvoices;
use App\Models\fee;
use App\Models\Grade;
use App\Models\student;
use App\Models\feeInvoice;
use App\Models\student_account;
use Illuminate\Support\Facades\DB;



class FeesInviocesRepository implements FeesInviocesRepositoryInterface {


 // show all feesinvioce
 public function index (){
    $Fee_invoices=feeInvoice::all();
    return view('pages.Fees_Invoices.index',compact('Fee_invoices'));

 }

 // go to add feesinvoice page
 public function Addinvioce($id){
    $student=student::findOrFail($id);

   $fees=fee::where('Classroom_id',$student->Classroom_id)->get();
//    dd($fees);

   return view('pages.Fees_Invoices.add',compact('student','fees'));
 }

 // create a feeinvoice function
 public function Createinvoice($request){
    $List_Feess = $request->List_Fees;

 // dd($List_Fees);
// dd($List_Fees['student_id']);
    DB::beginTransaction();
try{
   foreach( $List_Feess as $List_Fees){
     // insert at invoice table
     $invoice=new feeInvoice();
     $invoice->student_id=$List_Fees['student_id'];
     $invoice->fee_id=$List_Fees['fee_id'];
     $invoice->amount=$List_Fees['amount'];
     $invoice->description=$List_Fees['description'];
     $invoice->Grade_id=$request->Grade_id;
     $invoice->invoice_date=date('Y-m-d');
     $invoice->Classroom_id=$request->Classroom_id;
  $invoice->save();
  // insert at student_acounts table
  $student_acounts=new student_account();
  $student_acounts->date=date('Y-m-d');
  $student_acounts->type='invoice';
  $student_acounts->student_id=$List_Fees['student_id'];
  $student_acounts->Grade_id=$request->Grade_id;
  $student_acounts->Classromm_id=$request->Classroom_id;
  $student_acounts->Debit=$List_Fees['amount'];
  $student_acounts->credit=0.00;
  $student_acounts->description=$List_Fees['description'];
  $student_acounts->fee_invoice_id =$invoice->id;
  $student_acounts->save();

   }
   DB::commit();

   session()->flash('add',trans('messages.Update'));
   return redirect()->route('Fees_Invoices.index');
}catch (\Exception $e) {

    DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

 }
// update an existing fee
public function Editinvoice($id){
    $Fee_invoice=feeInvoice::findORFail($id);
    $fees=fee::where('Classroom_id',$Fee_invoice->Classroom_id)->get();

    return view('pages.Fees_Invoices.edit',compact('Fee_invoice','fees'));
}
// update an existing feeinvoice
public function Updateinvoice($request){
    DB::beginTransaction();
    try{

         // insert at invoice table
         $invoice= feeInvoice::findOrFail($request->id);
         $invoice->fee_id=$request->fee_id;
         $invoice->amount=$request->amount;
         $invoice->description=$request->description;
         $invoice->invoice_date=date('Y-m-d');
         $invoice->save();
      // insert at student_acounts table
      $student_acounts= student_account::where('fee_invoice_id',$request->id)->first();
      $student_acounts->date=date('Y-m-d');
      $student_acounts->Debit=$request->amount;
      $student_acounts->description=$request->description;
      $student_acounts->save();

       DB::commit();

       session()->flash('edit',trans('messages.Update'));
       return redirect()->route('Fees_Invoices.index');
    }catch (\Exception $e) {

        DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

}
 // delete afeeinvoice
 public function deleteinvoice($request){
    try{
        $invoice=feeInvoice::findOrFail($request->id);
        $invoice->delete();

       session()->flash('delete',trans('messages.Delete'));
       return redirect()->route('Fees_Invoices.index');
    }catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
 }



}
