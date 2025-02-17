<?php


namespace App\Http\Services;


use App\Models\Schedule;
use App\Http\Resources\ScheduleResource;
use Illuminate\Http\Request;

class ScheduleService
{
    public function createSchedule($data)
    {
        $schedule = Schedule::create($data);
        return new ScheduleResource($schedule);
    }

    public function getSchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        return new ScheduleResource($schedule);
    }

    public function updateSchedule($id, $data)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update($data);
        return new ScheduleResource($schedule);
    }

    public function deleteSchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
    }
    public function getStudentSchedule($studentId)
    {
        $schedule = Schedule::whereHas('subject.students', function ($query) use ($studentId) {
            $query->where('students.id', $studentId);
        })->with(['subject', 'teacher'])->get();

        return ScheduleResource::collection($schedule);
    }


}
