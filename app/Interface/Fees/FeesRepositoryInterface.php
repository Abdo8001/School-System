<?php
namespace App\Interface\Fees;


interface  FeesRepositoryInterface {


    // show all fees
    public function index ();

    // go to add fees page
    public function AddFees();

    // create a fee function
    public function CreateFee($request);
  // update an existing fee
  public function EditFee($id);
// update an existing fee
public function UpdateFee($request);
    // delete afee
    public function deleteFee($request);

}
