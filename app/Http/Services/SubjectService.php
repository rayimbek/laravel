<?php


namespace App\Http\Services;

use App\Models\Subject;
use App\Http\Resources\SubjectResource;

class SubjectService
{
    public function createSubject($data)
    {
        $subject = Subject::create($data);
        return new SubjectResource($subject);
    }

    public function getSubject($id)
    {
        $subject = Subject::findOrFail($id);
        return new SubjectResource($subject);
    }



}
