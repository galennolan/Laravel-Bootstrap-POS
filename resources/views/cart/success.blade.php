@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Order Success') }}</div>

                    <div class="card-body">
                        <p>Your order has been successfully placed.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection