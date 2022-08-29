<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'nim' => $this->faker->unique()->numerify('##########'),
            'gender' => ['male','female'][rand(0,1)],
            'address' => $this->faker->address,
            'major' => ['Teknik Informatika', 'Teknologi Informasi', 'Sistem Informasi'][rand(0,2)],
            'year' => rand(2019,2022)
        ];
    }
}
