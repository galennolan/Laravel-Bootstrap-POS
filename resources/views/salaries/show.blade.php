@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <p><strong>Amount:</strong> {{ $expense->amount }}</p>
                        <p><strong>Date:</strong> {{ $expense->date }}</p>
                        <p><strong>Description:</strong> {{ $expense->details }}</p>

                        <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-sm btn-primary">Edit</a>

                        <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
