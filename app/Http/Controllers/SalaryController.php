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
        $salaries = Salary::select('month_year', 'employee_id','amount')->groupBy('month_year', 'employee_id','amount')->get();
        $months = [];
        $employees = Employee::all();

        foreach ($salaries as $salary) {
            $month_year = $salary->month_year;
            $month = date('F', strtotime($month_year));
            $year = date('Y', strtotime($month_year));
            $months[$month_year] = $month . ' ' . $year;
        }

        return view('salary.index', compact('salaries', 'months', 'employees'));
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
        return view('salary.edit', compact('salary', 'employees', 'month', 'year'));
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

        return redirect()->route('salary.index')
            ->with('success', 'Salary record updated successfully');
        }

        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'employee_id' => 'required|integer',
                'amount' => 'required|numeric',
                'month' => 'required|integer',
                'year' => 'nullable|string',
            ]);
            $month = sprintf("%02d", $validatedData['month']);
            $salary = new Salary;
            $salary->employee_id = $validatedData['employee_id'];
            $salary->amount = $validatedData['amount'];
            $salary->date = date('Y-m-d');
            $salary->month_year = $validatedData['year'];

            $salary->save();

            return redirect()->route('salary.index')->with('success', 'Salary record has been created successfully!');
        }

        public function destroy(Salary $salary)
        {
            $salary->delete();
        
            return redirect()->route('salary.index')
                ->with('success', 'Salary record deleted successfully');
        }
        public function getEmployeeSalaries(Employee $employee)
        {
            $salaries = Salary::where('employee_id', $employee->id)->get();
        
            return view('salary.employee', compact('employee', 'salaries'));
        }
        

}