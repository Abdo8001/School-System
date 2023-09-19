<?php
namespace App\Interface\funds;


interface  RecieptRepositoryInterface {


    // show all fees
    public function index ();

    // go to add receipts page
    public function GoToAddReceipts($id);
    // go to add fees page
    public function AddFees();

    // create a fee function
    public function CreateReceipt($request);
  // update an existing fee
  public function EditReceipt($id);
// update an existing fee
public function UpdateReceipt($request);
    // delete afee
    public function deletereceipt($request);

}
