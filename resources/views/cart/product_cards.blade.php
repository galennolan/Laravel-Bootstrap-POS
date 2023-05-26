@foreach ($products as $product)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">Price: {{ $product->formatted_selling_price }}<br>Qty: {{ $product->quantity }}</p>
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i></button>
            </form>
        </div>
    </div>
@endforeach
