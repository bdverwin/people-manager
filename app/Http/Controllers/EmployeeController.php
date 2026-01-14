<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Services\MainServiceManager;

class EmployeeController extends Controller
{
    protected MainServiceManager $mainService;

    public function __construct(MainServiceManager $mainService){
        $this->mainService = $mainService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * get the  employees from specific department.
     */
    public function getDeptEmployees(string $id){
        $employees = $this->mainService->getEmployeesById($id);

        return view('layouts.employees', compact('employees', 'id'));
    }

    /**
     * get the  employees from specific department thru json.
     */
    public function getDeptEmployeesJson(string $id)
    {
        $employees = $this->mainService->getDeptEmployeesJson($id);

        return response()->json($employees);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthRequest $request)
    {
        $this->mainService->saveEmployee($request->validated());

        return response()->json([
            'message' => 'Employee created successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthRequest $request, string $id)
    {
        $this->mainService->updateEmployee($request->validated(), $id);

        return response()->json([
            'message' => 'Employee updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->mainService->deleteEmployee($id);

        return response()->json([
            'message' => 'Employee deleted successfully'
        ], 200);
    }
}
