@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Product List </div>
                    <div class="card-body">
                        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                      
                            <table class="table table-bordered tables-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Quantity</th>
                                    <th>Category</th>
                                    <th>Supplier</th>
                                    <th>Buying Price</th>
                                    <th>Selling Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->code }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->supplier->name }}</td>
                                        <td>{{ $product->buying_price }}</td>
                                        <td>{{ $product->selling_price }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm float-left mr-2">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
