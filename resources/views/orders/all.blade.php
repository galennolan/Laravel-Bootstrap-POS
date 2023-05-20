@extends('layouts.layout')

@section('content')
    <h1>All Orders</h1>

    <div class="chart-container">
        <canvas id="ordersChart"></canvas>
    </div>

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
                    <td>{{ $order->customer ? $order->customer->name : '' }}</td>
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
                    labels: orderDates,
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
@endsection
