<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created employee in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user.name' => ['bail', 'required', 'string', 'max:32'],
            'user.email' => ['bail', 'required', 'string', 'max:64', 'unique:users,email'],
            'user.password' => ['bail', 'required', 'string', 'max:64'],
            'employee.availability' => ['bail', 'required', 'array'],
            'employee.languages' => ['bail', 'required', 'array'],
            'employee.contact' => ['bail', 'required', 'array'],
            'employee.rung' => ['bail', 'required', 'string'],
        ]);

        //Process employee data
        $employeeData = $data['employee'];
        $employeeData['availability'] = json_encode($employeeData['availability']);
        $employeeData['languages'] = json_encode($employeeData['languages']);
        $employeeData['contact'] = json_encode($employeeData['contact']);

        //Create Employee
        $employee = Employee::create($employeeData);

        //Create User Instance
        $employee->user()->create($data['user']);
        $employee->load('user');

        return response()->json([
            'data' => ['employee' => $employee],
            'errors' => []
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
