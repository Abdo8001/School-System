<?php
namespace  App\Interface\feesinvoices\processing;



use Illuminate\Http\Request;



interface ProcessingFeeRepositoryInterface
{
    public function index();

    public function show($id);

    public function edit($id);

    public function store( $request);

    public function update($request);

    public function destroy($request);

}
