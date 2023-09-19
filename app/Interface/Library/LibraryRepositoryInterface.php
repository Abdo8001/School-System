<?php
namespace App\Interface\Library;






interface LibraryRepositoryInterface
{
    public function index();
    public function create();
    public function show($id);

    public function edit($id);
    public function download($file);

    public function store( $request);

    public function update($request);

    public function destroy($request);

}
