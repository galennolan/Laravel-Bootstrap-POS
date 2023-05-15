@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <h1>Edit Salary</h1>
    <hr>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Update Salary</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('salaries.update', $salary->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="employee_id">Employee</label>
                            <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ $salary->employee->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ $salary->amount }}">

                            @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="month">Month</label>
                            <select class="form-control @error('month') is-invalid @enderror" name="month" id="month">
                                <option value="1" {{ $salary->date == 1 ? 'selected' : '' }}>January</option>
                                <option value="2" {{ $salary->date == 2 ? 'selected' : '' }}>February</option>
                                <option value="3" {{ $salary->date == 3 ? 'selected' : '' }}>March</option>
                                <option value="4" {{ $salary->date == 4 ? 'selected' : '' }}>April</option>
                                <option value="5" {{ $salary->date == 5 ? 'selected' : '' }}>May</option>
                                <option value="6" {{ $salary->date == 6 ? 'selected' : '' }}>June</option>
                                <option value="7" {{ $salary->date == 7 ? 'selected' : '' }}>July</option>
                                <option value="8" {{ $salary->date == 8 ? 'selected' : '' }}>August</option>
                                <option value="9" {{ $salary->date == 9 ? 'selected' : '' }}>September</option>
                                <option value="10" {{ $salary->date == 10 ? 'selected' : '' }}>October</option>
                                <option value="11" {{ $salary->date == 11 ? 'selected' : '' }}>November</option>
                                <option value="12" {{ $salary->date == 12 ? 'selected' : '' }}>December</option>
                            </select>

                            @error('month')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="year">Year</label>
                            <input type="text" class="form-control @error('year') is-invalid @enderror" id="year" name="month_year" value="{{ $salary->month_year }}">

                            @error('year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection