<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class MergeDuplicateStudents extends Command
{
    protected $signature = 'students:merge-duplicates';
    protected $description = 'Объединяет дубликаты студентов, оставляя только одну запись.';

    public function handle()
    {
        DB::beginTransaction();
        try {
            $duplicates = Student::select('first_name', 'last_name', 'date_of_birth', 'room_id')
                ->groupBy('first_name', 'last_name', 'date_of_birth', 'room_id')
                ->havingRaw('COUNT(*) > 1')
                ->get();

            $totalMerged = 0;

            foreach ($duplicates as $duplicate) {
                $students = Student::where('first_name', $duplicate->first_name)
                    ->where('last_name', $duplicate->last_name)
                    ->where('date_of_birth', $duplicate->date_of_birth)
                    ->where('room_id', $duplicate->room_id)
                    ->orderBy('id', 'asc')
                    ->get();

                if ($students->count() > 1) {
                    $mainStudent = $students->first();
                    $duplicateStudents = $students->slice(1); // Остальные дубликаты

                    foreach ($duplicateStudents as $dupStudent) {
                        // Переносим связанные данные, если есть (пример для связей)
                        DB::table('grades')->where('student_id', $dupStudent->id)->update(['student_id' => $mainStudent->id]);
                        DB::table('attendances')->where('student_id', $dupStudent->id)->update(['student_id' => $mainStudent->id]);

                        // Удаляем дубликат
                        $dupStudent->delete();
                        $totalMerged++;
                    }
                }
            }

            DB::commit();
            $this->info("Объединено $totalMerged дубликатов.");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Ошибка: " . $e->getMessage());
        }
    }
}
