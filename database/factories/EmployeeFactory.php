<?php

namespace Database\Factories;
use App\Models\Employee;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    { static $id = 77777;
        return [
            'id' => $id++,
            'name' =>  $this->faker->name(),
            'department' => 'employee',
            'meals' => $this->faker->randomElement([1,2]),
        ];
    }
}
