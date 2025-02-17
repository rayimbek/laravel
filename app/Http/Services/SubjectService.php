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

    public function getStudentSchedule(Request $request)
    {
        $user = $request->user();

        if (!$user->isStudent()) {
            return response()->json(['message' => 'Нет доступа.'], 403);
        }

        $schedule = Schedule::whereHas('subject', function ($query) use ($user) {
            $query->whereIn('id', $user->subjects()->pluck('id'));
        })->get();

        return response()->json(['schedule' => $schedule]);
    }



}
