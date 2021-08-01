<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees=Employee::all();
        return view('employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeStoreRequest $request)
    {
        //
        Employee::create($request->validated());
        return redirect()->route('employees.index')->with('message','Employee created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeStoreRequest $request, Employee $employee)
    {
        //
        $employee->update([
            'username'=>$request->username,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'country_id'=>$request->country_id,
            'city_id'=>$request->city_id,
            'address'=>$request->address,
            'salary'=>$request->salary,
        ]);
        return redirect()->route('employees.index')->with('message','employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
        $employee->delete();
        return redirect()->route('employees.index');
    }
}
