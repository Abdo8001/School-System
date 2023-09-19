<?php
namespace  App\Interface\Teacher\TeacherDashboard;






interface QuizzeDashboardRepositryInterface
{
    public function index();
    public function create();
    public function show($id);

    public function edit($id);

    public function store( $request);

    public function update($request);

    public function destroy($request);
    public function getClasses($id);
    public function getAllSections($id);
    public function show_tested($id);
    public function repeat_test($request,$id);
}
