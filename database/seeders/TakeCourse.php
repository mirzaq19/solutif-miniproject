<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class TakeCourse extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::all();
        $courses = Course::all();
        foreach ($students as $student) {
            $student->courses()->attach(
                $courses->random(3)->pluck('id')->toArray(),
                [
                    'grade' => ['A', 'B', 'C', 'D', 'E'][rand(0, 4)],
                    'semester' => rand(1, 8),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
