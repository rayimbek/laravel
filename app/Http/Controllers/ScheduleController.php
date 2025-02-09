<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Services\ScheduleService;
use App\Http\Resources\ScheduleResource;

class ScheduleController extends Controller
{
    protected $scheduleService;

    public function __construct(ScheduleService $roomService)
    {
        $this->scheduleService = $roomService;
    }

    public function store(StoreScheduleRequest $request)
    {
        $schedule = $this->scheduleService->createSchedule($request->validated());
        return $schedule;
    }

    public function show($id)
    {
        $schedule = $this->scheduleService->getSchedule($id);
        return $schedule;
    }
}
