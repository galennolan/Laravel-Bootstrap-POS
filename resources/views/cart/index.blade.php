@extends('layouts.layout')

@section('content')

    <div class="container">
        <div class="row">
        
            <div class="col-md-6">
            <h2>Daftar Produk</h2>
            <div class="table-responsive">
        <table class="table table-bordered tables" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->formatted_selling_price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
            <div class="col-md-6">
                <h2>Your Cart</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $cartItem)
                            <tr>
                                <td>@if ($cartItem->product){{  $cartItem->product->name  }}@endif</td>
                                <td>@if ($cartItem->product)
                                    {{ $cartItem->product->formatted_selling_price }}
                                @endif</td>
                                <td>
                                    <form action="{{ route('cart.update', $cartItem->id) }}" method="POST" id="update-form-{{ $cartItem->id }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group">
                                            <input type="number" name="quantity" value="@if ($cartItem->product){{ $cartItem->quantity }}@endif" min="1" max="@if ($cartItem->product){{ $cartItem->product->quantity }}@endif" class="form-control" id="quantity-input-{{ $cartItem->id }}">
                                        </div>
                                    </form>
                                    
                                </td>
                                <td>{{ $cartItem->formatted_subtotal  }}</td>
                                <td>
                                <div class="d-flex align-items-center">
                                    
                                    <form action="{{ route('cart.increase', $cartItem->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success me-2">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('cart.decrease', $cartItem->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-minus"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger me-2">
                                            <i class="fas fa-shopping-cart fa-fw"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><strong>Total:</strong></td>
                            <td colspan="1"><strong>{{$subtotalpr}}</strong></td>
                            <td colspan="1"><strong>Rp{{ $formattedTotal }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <form action="{{ route('cart.order') }}" method="POST">
    <div class="form-group">
            <label for="customer_id">Pilih Customer:</label>
            <select class="form-control" id="customer_id" name="customer_id">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
    @csrf
    <button type="submit" class="btn btn-primary">Order All</button>
</form>
@endsection
