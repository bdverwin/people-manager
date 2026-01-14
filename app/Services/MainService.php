<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;


class MainService implements MainServiceManager {

    public function getEmployeesById(string $id){
        return Employee::where('department_id', $id)->get();
    }

    public function getDeptEmployeesJson(string $id){
        return Employee::where('department_id', $id)->get()->map(function($emp) {
            return [
                'id' => $emp->id,
                'name' => $emp->name,
                'email' => $emp->email,
                'created_at' => $emp->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $emp->updated_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function saveEmployee(array $data){
        Employee::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'department_id' => $data['department_id']
        ]);
    }

    public function updateEmployee(array $data, string $id){
        $employee = Employee::findOrFail($id);

        $employee->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    public function deleteEmployee(string $id){
        $employee = Employee::findOrFail($id);
        $employee->delete();
    }
}