@extends('layouts.layout')

@section('content')
    <h1>Returns</h1>
    <a href="{{ route('returns.create') }}" class="btn btn-primary">Create Return</a>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Order Detail</th>
                <th>Quantity</th>
                <th>Refund Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($returns as $return)
                <tr>
                    <td>{{ $return->id }}</td>
                    <td>{{ optional($return->orderDetail->product)->name }}</td>

                    <td>{{ $return->quantity }}</td>
                    <td>{{optional( $return->orderDetail->product)->selling_price * $return->quantity * 0.8 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
