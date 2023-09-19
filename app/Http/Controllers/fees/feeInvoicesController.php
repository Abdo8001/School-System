<?php

namespace App\Http\Controllers\fees;
use App\Http\Controllers\Controller;
use App\Models\feeInvoice;
use Illuminate\Http\Request;
use  App\Interface\feesinvoices\invoice\FeesInviocesRepositoryInterface;

class feeInvoicesController extends Controller
{
    protected $invoice;


    public function __construct( FeesInviocesRepositoryInterface $invoice){
        return $this->invoice=$invoice;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->invoice->index();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->invoice->Createinvoice($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->invoice->Addinvioce($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return $this->invoice->Editinvoice($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        return $this->invoice->Updateinvoice($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        return $this->invoice->deleteinvoice($request);

    }
}
