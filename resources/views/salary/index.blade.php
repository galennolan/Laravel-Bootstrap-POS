@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <h1>Salary Management</h1>
        <hr>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Add Salary</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('salaries.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="employee_id">Employee</label>
                                <select class="form-control @error('employee_id') is-invalid @enderror" name="employee_id" id="employee_id">
                                    <option value="">Select an employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                    @endforeach
                                </select>

                                @error('employee_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}">

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="month">Month</label>
                                <select class="form-control @error('month') is-invalid @enderror" name="month" id="month">
                                <option value="" selected disabled>Pilih Bulan</option>
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                </select>

                                @error('month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="text" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year') }}">

                                @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Salary List</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Employee</th>
                                    <th>Details</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($salaries as $salary)
                                <tr>
                                    <td>{{ date('d M Y', strtotime($salary->date)) }}</td>
                                    <td>{{ $salary->employee->name }}</td>
                                    <td>{{ $salary->month_year }}</td>
                                    <td>{{ $salary->amount }}</td>
                                    <td>
                                    <a href="{{ route('salary.show', $salary->id) }}" class="btn btn-primary btn-sm">View</a>
                                        <a href="{{ route('salary.edit', $salary->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        <form action="{{ route('salary.destroy', $salary->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
@endsection
