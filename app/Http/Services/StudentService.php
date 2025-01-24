<?php


namespace App\Services;

use App\Models\Student;
use App\Http\Resources\StudentResource;

class StudentService
{
    public function createStudent($data)
    {
        $student = Student::create($data);
        return new StudentResource($student);
    }

    public function getStudent($id)
    {
        $student = Student::findOrFail($id);
        return new StudentResource($student);
    }
}
