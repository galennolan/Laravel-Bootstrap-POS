@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Suppliers</div>

                    <div class="card-body">
                        <a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">Add Supplier</a>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $suppliers)
                                    <tr>
                                        <td>{{ $suppliers->name }}</td>
                                        <td>{{ $suppliers->email }}</td>
                                        <td>{{ $suppliers->address }}</td>
                                        <td>{{ $suppliers->phone }}</td>
                                        <td>
                                            @if($suppliers->photo)
                                                <img src="{{ asset('asset/img/supplier/' . $suppliers->photo) }}" width="50" alt="{{ $suppliers->name }}">
                                            @else
                                                No Photo
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('suppliers.show', $suppliers->id) }}" class="btn btn-sm btn-primary">View</a>
                                                <a href="{{ route('suppliers.edit', $suppliers->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('suppliers.destroy', $suppliers->id) }}" method="POST">
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