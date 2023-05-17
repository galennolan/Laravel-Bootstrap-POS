<?php

namespace App\Http\Controllers;

use App\Salary;
use App\Employee;
use Carbon\Carbon;
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
        $salaries = Salary::select('id','month_year','date', 'employee_id','amount')->get();
        $months = [];
        $employees = Employee::all();
        foreach ($salaries as $salary) {
            $month_year = $salary->month_year;
            $month = date('F', strtotime($month_year));
            $year = date('Y', strtotime($month_year));
            $months[$month_year] = $month . ' ' . $year;
        }

        return view('salaries.index', compact('salaries', 'months', 'employees'));
    }



    public function month_year($month_year)
    {
        $salaries = Salary::with('employee')->where('month_year', $month_year)->get();

        return view('salaries.month_year', compact('salaries', 'month_year'));
    }

    public function edit($id)
    {
        $salary = Salary::with('employee')->findOrFail($id);
        $salary->date = Carbon::createFromFormat('Y-m-d', $salary->date);
        return view('salaries.edit', compact('salary'));
    }
   
    public function update(Request $request,$id)
    {
      
        $validatedData = $request->validate([
            'employee_id' => 'required|integer',
            'amount' => 'required|numeric',
            'month' => 'required',
            'year' => 'required|numeric',
            'month_year' => 'nullable|string',
        ]);
        $date = $validatedData['year'] . '-' . $validatedData['month'] . '-01';

        $salary = Salary::findOrFail($id);
        $salary->employee_id = $validatedData['employee_id'];
        $salary->amount = $validatedData['amount'];
        $salary->date = $date;
        $salary->month_year = $validatedData['month_year'];


        $salary->save();

        return redirect()->route('salaries.index')->with('success', 'Salary record updated successfully');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|integer',
            'amount' => 'required|numeric',
            'month' => 'required|string',
            'year' => 'nullable|string',
        ]);


        $salary = new Salary;
        $salary->employee_id = $validatedData['employee_id'];
        $salary->amount = $validatedData['amount'];
        $salary->date = $validatedData['year'] . '-' . $validatedData['month'] . '-01';
        $salary->month_year = $validatedData['year'];

        $salary->save();

        return redirect()->route('salaries.index')->with('success', 'Salary record has been created successfully!');
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
        
            return view('salary.employee', compact('employee', 'salaries'));
        }
        

}