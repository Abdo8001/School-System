<?php
namespace  App\Interface\Student;






interface StudentRepositoryinterface {
// all students
    public function get_student();
    // create student view page
public function createStudent();
// create student function
public function insertStudent($request);
//go to edit page function
public function edit_student($id);
//go to update student function
public function update_student($request);
// get all section for student function
public function getSections($id);

// delete function
public function delete_student($id);
// show_Student
public function show_Student($id);
// upload uplodeImage
public function uplodeImage($request);
//  download_img
public function download_img($img_name,$student_id);
// Delete_attachment
public function Delete_attachment ($request);
}

