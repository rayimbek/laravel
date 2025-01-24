<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Schedule;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\StudentResource;
use App\Http\Resources\ScheduleResource;

class TeacherController extends Controller
{
    public function getRooms()
    {
        $rooms = Room::all();
        return response()->json($rooms);
    }

    public function getAllStudents()
    {
        $students = Student::with('room')->get();
        return response()->json($students);
    }

    public function getStudentsByClass($roomId)
    {
        $students = Student::where('room_id', $roomId)->with('room')->get();
        return response()->json($students);
    }


    public function createSubject(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $subject = Subject::create($request->only('name', 'teacher_id'));
        return response()->json($subject, 201);
    }

    public function createRoom(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $room = Room::create($request->only('name'));
        return response()->json($room, 201);
    }

    public function createStudent(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'room_id' => 'required|exists:rooms,id',
        ]);

        $student = Student::create($request->only('first_name', 'last_name', 'date_of_birth', 'room_id'));
        return response()->json($student, 201);
    }
    public function getScheduleByRoom($roomId)
    {
        $schedules = Schedule::where('room_id', $roomId)->get();
        return ScheduleResource::collection($schedules);
    }


}
