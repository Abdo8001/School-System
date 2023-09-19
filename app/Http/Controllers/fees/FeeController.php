<?php

namespace App\Http\Controllers\fees;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeesRequest;

use  App\Interface\Fees\FeesRepositoryInterface;
use App\Models\fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    protected $fee;


    public function __construct(FeesRepositoryInterface $fee){

        return $this->fee=$fee;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->fee->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->fee->AddFees();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeesRequest $request)
    {
        return $this->fee->CreateFee($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(fee $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return $this->fee->EditFee($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFeesRequest $request)
    {
        return $this->fee->UpdateFee($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        return $this->fee->deleteFee($request);

    }
}
