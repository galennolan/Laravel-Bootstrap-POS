@extends('layouts.layout')

@section('content')
    <h1>Yesterday's History</h1>

    <h2>Total: ${{ $data['total'] }}</h2>
    <h2>Paid: ${{ $data['paid'] }}</h2>
    <h2>Due: ${{ $data['due'] }}</h2>
    <h2>Expense: ${{ $data['expense'] }}</h2>

    <!-- Display other data as needed -->
@endsection
