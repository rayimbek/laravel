<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Services\ScheduleService;
use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $scheduleService;

    public function __construct(ScheduleService $roomService)
    {
        $this->scheduleService = $roomService;
    }

    public function store(StoreScheduleRequest $request)
    {
        $this->authorize('create', Schedule::class);

        $schedule = $this->scheduleService->createSchedule($request->validated());
        return $schedule;
    }

    public function show($id)
    {
        $schedule = $this->scheduleService->getSchedule($id);
        return $schedule;
    }

    public function update(Request $request, Schedule $schedule)
    {
        $this->authorize('update', $schedule);

        $request->validate([
            'subject_id' => 'sometimes|exists:subjects,id',
            'teacher_id' => 'sometimes|exists:users,id',
            'room_id' => 'sometimes|exists:rooms,id',
            'date' => 'sometimes|date',
            'start_time' => 'sometimes|date_format:H:i',
            'end_time' => 'sometimes|date_format:H:i|after:start_time',
        ]);

        return response()->json($this->scheduleService->updateSchedule($schedule->id, $request->all()));
    }
    public function destroy(Schedule $schedule)
    {
        $this->authorize('delete', $schedule);

        $this->scheduleService->deleteSchedule($schedule->id);

        return response()->json(['message' => 'Расписание удалено.']);
    }
    public function getStudentSchedule(Request $request)
    {
        $user = $request->user();

        if (!$user->isStudent()) {
            return response()->json(['message' => 'Нет доступа.'], 403);
        }

        $schedule = $this->scheduleService->getStudentSchedule($user->id);

        return response()->json(['schedule' => $schedule]);
    }
}
