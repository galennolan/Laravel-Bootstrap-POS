@extends('layouts.layout')

@section('content')
    <h1>Order Details</h1>

    <p><strong>Order ID:</strong> {{ $customerOrder->id }}</p>
    <p><strong>Customer Name:</strong> {{ $customerOrder->customer->name }}</p>
    <p><strong>Date:</strong> {{ $customerOrder->date }}</p>
    <p><strong>Total:</strong> {{ $customerOrder->total }}</p>
    <p><strong>Paid:</strong> {{ $customerOrder->paid }}</p>
    <p><strong>Due:</strong> {{ $customerOrder->due }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{  $order->product->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->sub_total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection