@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $customer->name }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('asset/img/customer/' . $customer->photo) }}" alt="{{ $customer->name }}" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <table class="table">
                                    <tr>
                                        <td>Name:</td>
                                        <td>{{ $customer->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td>{{ $customer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address:</td>
                                        <td>{{ $customer->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone:</td>
                                        <td>{{ $customer->phone }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection