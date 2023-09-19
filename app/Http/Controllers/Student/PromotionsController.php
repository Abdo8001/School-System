<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;

use App\Models\promotions;
use Illuminate\Http\Request;
use App\Interface\Student\StudentPromoted\StudentPromotionRepositoryinterface;


class PromotionsController extends Controller
{
 protected $promotion;


 public function __construct( StudentPromotionRepositoryinterface $promotion){

    return $this->promotion=$promotion;
 }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return $this->promotion->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->promotion->showAll();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->promotion->store_New_promotion($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(promotions $promotions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(promotions $promotions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, promotions $promotions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->promotion->DestroyAll($request);

    }
}
