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
                            <label for="employee_name">Employee</label>
                            <input type="text" class="form-control" id="employee_name" name="employee_name" value="{{ $salary->employee->name }}" readonly>
                            <input type="hidden" name="employee_id" value="{{ $salary->employee->id }}">
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
        <option value="" selected disabled>Pilih Bulan</option>
        <option value="1" {{ $salary->date->format('m') == 1 ? 'selected' : '' }}>Januari</option>
        <option value="2" {{ $salary->date->format('m') == 2 ? 'selected' : '' }}>Februari</option>
        <option value="3" {{ $salary->date->format('m') == 3 ? 'selected' : '' }}>Maret</option>
        <option value="4" {{ $salary->date->format('m') == 4 ? 'selected' : '' }}>April</option>
        <option value="5" {{ $salary->date->format('m') == 5 ? 'selected' : '' }}>Mei</option>
        <option value="6" {{ $salary->date->format('m') == 6 ? 'selected' : '' }}>Juni</option>
        <option value="7" {{ $salary->date->format('m') == 7 ? 'selected' : '' }}>Juli</option>
        <option value="8" {{ $salary->date->format('m') == 8 ? 'selected' : '' }}>Agustus</option>
        <option value="9" {{ $salary->date->format('m') == 9 ? 'selected' : '' }}>September</option>
        <option value="10" {{ $salary->date->format('m') == 10 ? 'selected' : '' }}>Oktober</option>
        <option value="11" {{ $salary->date->format('m') == 11 ? 'selected' : '' }}>November</option>
        <option value="12" {{ $salary->date->format('m') == 12 ? 'selected' : '' }}>Desember</option>
    </select>

    <label for="year">Year</label>
    <input type="text" class="form-control @error('year') is-invalid @enderror" name="year" id="year" value="{{ $salary->date->format('Y') }}">

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