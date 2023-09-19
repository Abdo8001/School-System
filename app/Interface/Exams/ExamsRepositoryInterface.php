<?php
namespace App\Interface\Exams;






interface ExamsRepositoryInterface
{
    public function index();
    public function create();
    public function show($id);

    public function edit($id);

    public function store( $request);

    public function update($request);

    public function destroy($request);

}
