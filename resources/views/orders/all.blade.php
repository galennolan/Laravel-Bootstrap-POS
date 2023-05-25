@extends('layouts.layout')

@section('content')
    <h1>All Orders</h1>
   
    
    <div class="chart-container">
        <canvas id="ordersChart"></canvas>
    </div>
    <div class="table-container">
    <table class="table table-striped">
        <thead style="background-color: #333; color: #fff;">
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
                    <td>{{ $order->customer ? $order->customer->name : '' }}</td>
                    <td>{{ date('d-m-y', strtotime($order->date)) }}</td>
                    <td>{{ number_format($order->total, 0, ',', '.') }}</td>
                    <td>{{ number_format($order->paid, 0, ',', '.') }}</td>

                    <td>{{ $order->due }}</td>
                    <td>
                        <a href="{{ route('orders.details', $order->id) }}" class="btn btn-sm btn-primary">Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ordersData = {!! json_encode($orders) !!};
            var orderDates = ordersData.map(function(order) {
                return order.date;
            });
            var orderTotals = ordersData.map(function(order) {
                return order.total;
            });

            var ctx = document.getElementById('ordersChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: orderDates.map(function(label) {
                        return label.split('-').reverse().join('-');
                    }),
                    datasets: [{
                        label: 'Order Total',
                        data: orderTotals,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    return 'Rp' + value;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    <style>
        .chart-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .table-container {
            overflow-x: auto;
            max-width: 100%;
        }
    </style>
@endsection
