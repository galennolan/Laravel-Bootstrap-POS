@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Expenses</div>

                    <div class="card-body">
                        <a href="{{ route('expenses.create') }}" class="btn btn-primary mb-3">Add Expense</a>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>details</th>
                                    <th>Amount</th>
                                
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expenses as $expense)
                                    <tr>
                                        <td>{{ date('d/m/y', strtotime($expense->date)) }}</td>
                                        <td>{{ $expense->details }}</td>
                                        <td>{{ $expense->amount }}</td>
                                 
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('expenses.show', $expense->id) }}" class="btn btn-sm btn-primary">View</a>
                                                <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
