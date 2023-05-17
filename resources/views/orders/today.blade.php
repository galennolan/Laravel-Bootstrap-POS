@extends('layouts.layout')

@section('content')
    <h1>Today's Orders</h1>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->date }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->paid }}</td>
                    <td>{{ $order->due }}</td>
                    <td>
                        <a href="{{ route('orders.details', $order->id) }}" class="btn btn-sm btn-primary">Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection