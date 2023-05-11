@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $supplier->name }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                            <img src="{{ asset('asset/img/supplier/' . $supplier->photo) }}" alt="{{ $supplier->name }}" class="img-fluid">                            </div>
                            <div class="col-md-8">
                                <table class="table">
                                <tr>
                                    <td>Name:</td>
                                    <td>{{ $supplier->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>{{ $supplier->email }}</td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td>{{ $supplier->address }}</td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td>{{ $supplier->phone }}</td>
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