<?php

namespace App\Http\Controllers\fees;
use App\Http\Controllers\Controller;
use App\Models\ReceiptStudents;
use Illuminate\Http\Request;
use App\Interface\funds\RecieptRepositoryInterface;


class ReceiptStudentsController extends Controller
{

    protected $student_reciept;


    public function __construct(RecieptRepositoryInterface $student_reciept){

        return $this->student_reciept=$student_reciept;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->student_reciept->index();


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
        return $this->student_reciept->CreateReceipt($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->student_reciept->GoToAddReceipts($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->student_reciept->EditReceipt($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'Debit'=>'required|numeric',
            'description'=>'required',
        ],[
            'Debit.required'=>trans('validation.required'),
            'description.required'=>trans('validation.required')
        ]);
        return $this->student_reciept->UpdateReceipt($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->student_reciept->deletereceipt($request);

    }
}
