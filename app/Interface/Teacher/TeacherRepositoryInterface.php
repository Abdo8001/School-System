<?php
namespace App\Interface\Teacher;


interface TeacherRepositoryInterface{
    // gett all teachers
    public function GetAllTeachers();
    //    // gett all genders
    public function GetAllGenders();
    //    // gett all spicilizaion
    public function GetAllSpecilazation();
        // create function
        public function Create_Teacher($request);
        public function FindById($id);
        public function updateTeacher($request);

     public function deleteTeacher($id);

}
