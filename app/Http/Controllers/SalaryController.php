<?php

namespace App\Http\Controllers;

use App\Salary;
use App\Employee;

use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // Fetch all unique month_year values from the Salary model
        $salaries  = Salary::select('month_year')->distinct()->get();
        $employees = Employee::all();

        return view('salary.index', compact('salaries', 'employees'));
    }


    public function month_year($month_year)
    {
        $salaries = Salary::with('employee')->where('month_year', $month_year)->get();

        return view('salary.month_year', compact('salaries', 'month_year'));
    }

    public function edit(Salary $salary)
    {
        $employees = Employee::all();
        $month = explode('_', $salary->month_year)[0];
        $year = explode('_', $salary->month_year)[1];
        return view('salaries.edit', compact('salary', 'employees', 'month', 'year'));
    }

    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'employee_id' => 'required|integer',
            'amount' => 'required|numeric',
            'month' => 'required|string',
            'year' => 'required|integer|min:2000|max:2099',
        ]);

        $month_year = $request->month . "_" . $request->year;

        $salary->employee_id = $request->employee_id;
        $salary->amount = $request->amount;
        $salary->month_year = $month_year;
        $salary->date = date('Y-m-d');
        $salary->save();

        return redirect()->route('salaries.index')
            ->with('success', 'Salary record updated successfully');
        }
        public function destroy(Salary $salary)
        {
            $salary->delete();
        
            return redirect()->route('salaries.index')
                ->with('success', 'Salary record deleted successfully');
        }
        public function getEmployeeSalaries(Employee $employee)
        {
            $salaries = Salary::where('employee_id', $employee->id)->get();
        
            return view('salaries.employee', compact('employee', 'salaries'));
        }
        

}