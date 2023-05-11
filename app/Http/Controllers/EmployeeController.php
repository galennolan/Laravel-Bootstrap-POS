<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|unique:employees|max:255',
            'email'        => 'required|email|unique:employees|max:255',
            'address'      => 'required',
            'phone'        => 'required|numeric|unique:employees',
            'nid'          => 'nullable|numeric|unique:employees',
            'joining_date' => 'required|date',
            'salary'       => 'required|numeric',
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->photo) {
            $img_name = time() . '.' . $request->photo->getClientOriginalExtension();
            $path = public_path('asset/img/employee/' . $img_name);

            $img = Image::make($request->photo->path());
            $img->resize(300, 200);
            $img->save($path);
        } else {
            $img_name = null;
        }

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->nid = $request->nid;
        $employee->photo = $img_name;
        $employee->joining_date = $request->joining_date;
        $employee->salary = $request->salary;
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
            return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
       
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
       
        $request->validate([
            'name'         => 'required|max:255|unique:employees,name,' . $employee->id,
            'email'        => 'required|email|max:255|unique:employees,email,' . $employee->id,
            'address'      => 'required',
            'phone'        => 'required|numeric|unique:employees,phone,' . $employee->id,
            'nid'          => 'nullable|numeric|unique:employees,nid,' . $employee->id,
            'joining_date' => 'required|date',
            'salary'       => 'required|numeric',
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->photo) {
            Storage::delete('public/employee/' . $employee->photo);
            $img_name = time() . '.' . $request->photo->getClientOriginalExtension();
            $path = public_path('asset/img/employee/' . $img_name);

            $img = Image::make($request->photo->path());
            $img->resize(300, 200);
            $img->save($path);

            $employee->photo = $img_name;
        }

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->nid = $request->nid;
        $employee->joining_date = $request->joining_date;
        $employee->salary = $request->salary;
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

        if ($employee->photo != null) {
            $old_photo = public_path('asset/img/employee/') . $employee->photo;
            if (file_exists($old_photo)) {
                unlink($old_photo);
            }
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}