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



}
