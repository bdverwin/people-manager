<?php

namespace App\Services;

interface MainServiceManager{

    public function getEmployeesById(string $id);

    public function getDeptEmployeesJson(string $id);

    public function saveEmployee(array $data);

    public function updateEmployee(array $data, string $id);

    public function deleteEmployee(string $id);
}