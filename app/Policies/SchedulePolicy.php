<?php

namespace App\Policies;

use App\Models\Schedule;
use App\Models\User;

class SchedulePolicy
{
    /**
     * Ученики могут видеть только расписание своего класса (room_id).
     */
    public function view(User $user, Schedule $schedule)
    {
        return $user->isStudent() && $user->room_id === $schedule->room_id;
    }

    /**
     * Учителя могут создавать расписание.
     */
    public function create(User $user)
    {
        return $user->isTeacher();
    }

    /**
     * Учителя могут обновлять только своё расписание.
     */
    public function update(User $user, Schedule $schedule)
    {
        return $user->isTeacher() && $user->id === $schedule->teacher_id;
    }

    /**
     * Учителя могут удалять только своё расписание.
     */
    public function delete(User $user, Schedule $schedule)
    {
        return $user->isTeacher() && $user->id === $schedule->teacher_id;
    }
}
