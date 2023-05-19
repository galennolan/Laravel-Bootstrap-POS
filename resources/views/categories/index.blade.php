@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Browse Categories</h1>
        <p>Choose from a wide range of categories to find what interests you.</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td> 
                            
                            <button type="button" class="btn btn-sm btn-outline-primary me-2" onclick="window.location='{{ route('categories.edit', $category->id) }}'">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-sm btn-outline-danger me-2"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <h2>Create a New Category</h2>
        <p>Don't see the category you're looking for? Create a new one!</p>
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    </div>
@endsection