@extends('layouts.layout')

@section('content')
    <h1>Create Return</h1>

    <form action="{{ route('returns.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="order_detail_id">Order Detail:</label>
            <select name="order_detail_id" id="order_detail_id" class="form-control">
                <option value="">Select an order detail</option>
                @foreach ($orderDetails as $orderDetail)
                    <option value="{{$orderDetail->id }}">{{ optional($orderDetail->product)->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
