<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class GradeController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('create', Grade::class);

        $request->validate([
            'student_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|integer|min:1|max:10',
            'comment' => 'nullable|string',
        ]);

        $teacher = $request->user();

        // Проверяем, преподаёт ли учитель этот предмет
        if (!$teacher->subjects()->where('subject_id', $request->subject_id)->exists()) {
            return response()->json(['message' => 'Вы не преподаёте этот предмет.'], 403);
        }

        $grade = Grade::create([
            'teacher_id' => $teacher->id,
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'grade' => $request->grade,
            'comment' => $request->comment,
        ]);

        return response()->json(['message' => 'Оценка выставлена.', 'grade' => $grade]);
    }

    public function getStudentGrades(Request $request, $student_id)
    {
        $user = $request->user();

        // Проверяем доступ: ученик может видеть только свои оценки, учитель — любого ученика
        if ($user->isStudent() && $user->id != $student_id) {
            return response()->json(['message' => 'Нет доступа.'], 403);
        }

        $grades = Grade::where('student_id', $student_id)
            ->with(['teacher', 'subject'])
            ->get();

        return response()->json(['grades' => $grades]);
    }

    public function update(Request $request, Grade $grade)
    {
        $this->authorize('update', $grade);

        $request->validate([
            'grade' => 'required|integer|min:1|max:10',
            'comment' => 'nullable|string',
        ]);

        $grade->update([
            'grade' => $request->grade,
            'comment' => $request->comment,
        ]);

        return response()->json(['message' => 'Оценка обновлена.', 'grade' => $grade]);
    }

    public function destroy(Request $request, Grade $grade)
    {
        $this->authorize('delete', $grade);

        $grade->delete();
        return response()->json(['message' => 'Оценка удалена.']);
    }
}
