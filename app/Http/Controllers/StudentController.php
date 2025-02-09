<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Services\StudentService;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function store(StoreStudentRequest $request)
    {
        $student = $this->studentService->createStudent($request->validated());
        return $student;
    }

    public function show($id)
    {
        $student = $this->studentService->getStudent($id);
        return $student;
    }
}
