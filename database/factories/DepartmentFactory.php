<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Department::class;

    public function definition(): array
    {
        $departments = [
            'Engineering',
            'Human Resources',
            'Marketing',
            'Sales',
            'Finance',
            'Customer Support',
            'Operations',
            'IT',
            'Research & Development',
            'Legal',
        ];

         return [
            'name' => $this->faker->unique()->randomElement($departments),
        ];
    }
}
