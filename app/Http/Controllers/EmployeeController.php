<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmployeeResource::collection(Employee::with('user')->get());
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

        //Create Employee
        $employee = Employee::create($employeeData);

        //Create User Instance
        $employee->user()->create($data['user']);
        $employee->load('user');

        return new EmployeeResource($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $employee->load('user');

        return new EmployeeResource($employee);
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
