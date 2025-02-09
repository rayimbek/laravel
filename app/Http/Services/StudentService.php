<?php


namespace App\Http\Services;

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

    public function checkForDuplicate(){
        $duplicates = Student::select('first_name', 'last_name', 'date_of_birth', 'room_id')
            ->groupBy('first_name', 'last_name', 'date_of_birth', 'room_id')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicates as $duplicate) {
            Student::where('first_name', $duplicate->first_name)
                ->where('last_name', $duplicate->last_name)
                ->where('date_of_birth', $duplicate->date_of_birth)
                ->where('room_id', $duplicate->room_id)
                ->orderBy('id', 'asc')
                ->skip(1) // Оставляем 1 запись, остальные удаляем
                ->delete();
        }
//        Student::whereIn('id',$aIds)->delete();
    }

}
