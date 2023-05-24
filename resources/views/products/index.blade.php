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
                      
                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                     <th>Photo</th>   
                                    <th>Name</th>
                                    <th>Quantity</th>                      
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>
                                            @if($product->photo)
                                                <img src="{{ asset('asset/img/product/' . $product->photo) }}" width="100" alt="{{ $product->name }}">
                                            @else
                                                No Photo
                                            @endif
                                        </td>
                                        <td><span class="font-weight-bold">{{ $product->name }}</Span>
                                            <br><small>{{ number_format($product->buying_price, 0, ',', '.') }}</small>
                             
                                           <br> <small>{{ $product->category->name }}</small>
                                        </td>
                                        <td>{{ $product->quantity }}</td>                       
                                        <td>{{ number_format($product->selling_price, 0, ',', '.') }}</td>
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
