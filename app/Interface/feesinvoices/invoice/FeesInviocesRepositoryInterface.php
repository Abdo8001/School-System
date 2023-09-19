<?php

namespace  App\Interface\feesinvoices\invoice;




interface FeesInviocesRepositoryInterface {


 // show all feesinvioce
 public function index ();

 // go to add feesinvoice page
 public function Addinvioce($id);

 // create a feeinvoice function
 public function Createinvoice($request);
// update an existing fee
public function Editinvoice($id);
// update an existing feeinvoice
public function Updateinvoice($request);
 // delete afeeinvoice
 public function deleteinvoice($request);

}
