<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Room;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\Subject;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class  DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Sergey',
            'surname' => 'Lazarev',
            'email' => 'sergeyy@example.com',
            'phone' => '123101-0233-02',
            'date_of_birth' => '2001-02-02',
            'password' => Hash::make('password'),
        ]);

        $room = Room::create(['name' => '1A']);

        Student::create([
            'first_name' => 'Иван',
            'last_name' => 'Иванов',
            'date_of_birth' => '2010-01-01',
            'room_id' => $room->id,
        ]);

        Student::create([
            'first_name' => 'Иван',
            'last_name' => 'Иванов',
            'date_of_birth' => '2011-02-02',
            'room_id' => $room->id,
        ]);

        $subject = Subject::create([
            'name' => 'Mathematics',
        ]);

        DB::table('subjects')->insert([
            ['name' => 'Математика'],
            ['name' => 'Русский язык'],
            ['name' => 'Физика'],
        ]);

        Schedule::create([
            'room_id' => $room->id,
            'week_day' => 'Monday',
            'subject_id' => $subject->name,
            'teacher_id' => $subject->name,
            'start_time' => '09:00',
            'end_time' => '10:00',
        ]);


    }
}
