@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Today's History</h1>

    <div class="card-deck">
        <div class="card">
            <div class="card-header">
                <div class="card-header-content">
                    <i class="fas fa-dollar-sign"></i>
                    <h5 class="card-title">Total</h5>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">${{ $data['total'] }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-header-content">
                    <i class="fas fa-money-bill"></i>
                    <h5 class="card-title">Paid</h5>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">Rp{{ $data['paid'] }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-header-content">
                    <i class="fas fa-money-bill-alt"></i>
                    <h5 class="card-title">Due</h5>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">Rp{{ $data['due'] }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-header-content">
                    <i class="fas fa-dollar-sign"></i>
                    <h5 class="card-title">Expense</h5>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">Rp{{ $data['expense'] }}</p>
            </div>

        </div>
    </div>

    <div class="dashboard-section">
        <h2>Top Sold Products</h2>
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity Sold</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['top_sold'] as $orderDetail)
                <tr>
                    <td>{{ $orderDetail->name }}</td>
                    <td>{{ $orderDetail->total_sold }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
