<?php

namespace App\Policies;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GradePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->isTeacher();
    }

    public function update(User $user, Grade $grade)
    {
        return $user->isTeacher() && $user->id === $grade->teacher_id;
    }

    public function delete(User $user, Grade $grade)
    {
        return $user->isTeacher() && $user->id === $grade->teacher_id;;
    }

    public function view(User $user, Grade $grade)
    {
        return $user->isTeacher() || $user->id === $grade->student_id;
    }
}
