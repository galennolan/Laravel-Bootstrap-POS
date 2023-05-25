@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Today's History</h1>

        <div class="dashboard-section">
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <i class="fas fa-dollar-sign"></i> Total
                </div>
                <div class="dashboard-card-body">
                    <h2>${{ $data['total'] }}</h2>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <i class="fas fa-money-bill"></i> Paid
                </div>
                <div class="dashboard-card-body">
                    <h2>${{ $data['paid'] }}</h2>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <i class="fas fa-money-bill-alt"></i> Due
                </div>
                <div class="dashboard-card-body">
                    <h2>${{ $data['due'] }}</h2>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <i class="fas fa-dollar-sign"></i> Expense
                </div>
                <div class="dashboard-card-body">
                    <h2>${{ $data['expense'] }}</h2>
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
