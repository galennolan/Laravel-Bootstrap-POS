@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Employees</div>
                    <div class="card-body">
                        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add Employees</a>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Joining Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->id }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>{{ $employee->address }}</td>
                                        <td>{{ $employee->joining_date }}</td>
                                        <td>
                                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-primary btn-sm">View</a>
                                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                            
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline-block">
                                            @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</button>
                                            </form>
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