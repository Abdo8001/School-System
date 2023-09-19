<?php

namespace  App\Interface\Student\StudentGraduted;

interface   StudentGraduatedRepositoryInterface {
    // show all graduted students
    public function ShowAll();
    // MakeGradute student
    public function MakeGradute();
     // softdelte function
     public function MakeStudentGraduted($request);
     // undo gradution
     public function gradutionRollBack($request);
    // pramently delete for student student_id
    public function destroy_student($request);
}
