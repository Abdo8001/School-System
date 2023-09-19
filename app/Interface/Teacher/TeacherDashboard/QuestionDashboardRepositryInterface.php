<?php
namespace  App\Interface\Teacher\TeacherDashboard;






interface QuestionDashboardRepositryInterface
{
    public function index();
    public function create();
    public function show($id);

    public function edit($id);

    public function store( $request);

    public function update($request,$id);

    public function destroy($request);

}
