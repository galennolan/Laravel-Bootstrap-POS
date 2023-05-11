@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Categories</h1>
        <ul>
            @foreach ($categories as $category)
                <li>
                    {{ $category->name }}
                    <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
                    <form method="POST" action="{{ route('categories.destroy', $category->id) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection