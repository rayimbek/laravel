<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Services\SubjectService;
use App\Http\Resources\SubjectResource;

class SubjectController extends Controller
{
    protected $subjectService;

    public function __construct(SubjectService $roomService)
    {
        $this->subjectService = $roomService;
        return $roomService;
    }

    public function store(StoreSubjectRequest $request)
    {
        $subject = $this->subjectService->createSubject($request->validated());
        return $subject;
    }

    public function show($id)
    {
        $subject = $this->subjectService->getSubject($id);
        return $subject;
    }
}
