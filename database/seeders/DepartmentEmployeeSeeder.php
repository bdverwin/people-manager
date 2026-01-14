<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Employee;

class DepartmentEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::factory()
            ->count(5)
            ->create()
            ->each(function ($department) {
                Employee::factory()
                    ->count(5)
                    ->create([
                        'department_id' => $department->id,
                    ]);
            });
    }
}
