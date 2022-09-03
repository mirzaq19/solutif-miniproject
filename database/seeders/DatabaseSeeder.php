<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        User::factory(40)
//            ->has(
//                Student::factory()
//                    ->count(1)
//                    ->state(function (array $attributes, User $user) {
//                        return ['user_id' => $user->id,'name' => $user->name];
//            }))->create();
        $students = Student::factory(40)->create();
        Course::factory(30)->create();
        $this->call(TakeCourse::class);
    }
}
