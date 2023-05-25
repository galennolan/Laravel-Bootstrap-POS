@extends('layouts.app')

@section('content')
    <h1>Category Products</h1>

    <ul>
        @foreach ($products as $product)
            <li>{{ $product->name }} - Category: {{ $product->category->name }}</li>
        @endforeach
    </ul>
@endsection
