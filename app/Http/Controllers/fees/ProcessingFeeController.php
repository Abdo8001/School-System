<?php
namespace App\Http\Controllers\fees;
use App\Http\Controllers\Controller;

use App\Models\processing_fee;
use Illuminate\Http\Request;
use  App\Interface\feesinvoices\processing\ProcessingFeeRepositoryInterface;


class ProcessingFeeController extends Controller
{
    protected $processing_fee;



    public function __construct( ProcessingFeeRepositoryInterface $processing_fee){

        return $this->processing_fee=$processing_fee;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->processing_fee->index();

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
        $this->validate($request,[
            'Debit'=>'required|numeric',
            'description'=>'required',
        ],[
            'Debit.required'=>trans('validation.required'),
            'description.required'=>trans('validation.required')
        ]);
        return $this->processing_fee->store($request);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->processing_fee->show($id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return $this->processing_fee->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->processing_fee->update($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->processing_fee->destroy($request);

    }
}
