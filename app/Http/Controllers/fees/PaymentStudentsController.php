<?php
namespace App\Http\Controllers\fees;
use App\Http\Controllers\Controller;
use App\Models\PaymentStudents;
use Illuminate\Http\Request;
use App\Interface\feesinvoices\Payment\PaymentRepositoryInterface;


class PaymentStudentsController extends Controller
{

    protected $payment_student;




    public function  __construct(PaymentRepositoryInterface $payment_student){

        return $this->payment_student=$payment_student;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->payment_student->index();
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
        return $this->payment_student->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        return $this->payment_student->show($id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return $this->payment_student->edit($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->payment_student->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->payment_student->destroy($request);

    }
}
