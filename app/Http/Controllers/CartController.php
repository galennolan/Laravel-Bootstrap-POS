<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;

class CartController extends Controller
{
    private function formatPrice($price) {
        return number_format($price, 0, ',', '.');
    }

    public function index()
    {
        $products = Product::available()->get();
        $cartItems = Cart::with('product')->get();
        $total = 0;
        //pemformatan cartitem
        foreach ($cartItems as $cartItem) {
        
            $cartItem->product->formatted_selling_price = $this->formatPrice($cartItem->product->selling_price);
            $cartItem->formatted_subtotal = $this->formatPrice($cartItem->product->selling_price * $cartItem->quantity); //subtotal
            $total += $cartItem->product->selling_price * $cartItem->quantity;
        }
        //pemformatan produk
        foreach ($products as $product) {
            $product->formatted_selling_price = $this->formatPrice($product->selling_price);
        }

        $formattedTotal = $this->formatPrice($total);

        return view('cart.index', compact('products', 'cartItems', 'formattedTotal'));
    }



    public function store(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $cart = Cart::where('product_id', $request->id)->first();

        if ($cart) {
            $cart->quantity = $cart->quantity + 1;
            $cart->save();
        } else {
            $cart = new Cart();
            $cart->product_id = $product->id;
            $cart->quantity = 1;
            $cart->save();
        }

        return redirect()->route('cart.index');
    }
    public function order(Request $request)
    {
        $cartItems = Cart::with('product')->get();

        $order = new Order();
    
        $order->total_price = Cart::total();
        $order->save();

        foreach ($cartItems as $cartItem) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cartItem->product->id;
            $orderDetail->quantity = $cartItem->quantity;
            $orderDetail->price = $cartItem->product->selling_price;
            $orderDetail->save();
        }

        Cart::truncate();

        return redirect()->route('order.success');
    }
    public function increase($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity = $cart->quantity + 1;
        $cart->save();

        return redirect()->route('cart.index');
    }

    public function decrease($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity = $cart->quantity - 1;
        $cart->save();

        if ($cart->quantity === 0) {
            $cart->delete();
        }

        return redirect()->route('cart.index');
    }
    
    public function update($id, Request $request)
    {
        // Get the cart item by ID
        $cartItem = Cart::findOrFail($id);
    
        // Get the product associated with the cart item
        $product = Product::findOrFail($cartItem->product_id);
    
        // Validate the new quantity value
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->quantity,
        ]);
    
        // Get the new quantity value from the request
        $newQuantity = $request->input('quantity');
    
        // Calculate the difference between the old and new quantity values
        $quantityDifference = $newQuantity - $cartItem->quantity;
    
        // Update the cart item quantity
        $cartItem->quantity = $newQuantity;
        $cartItem->update();
    
        // Update the product quantity
        $product->quantity -= $quantityDifference;
        $product->update();
    
        // Redirect back to the cart page
        return redirect()->route('cart.index');
    }
    public function destroy($id)
    {
        // Get the cart item by ID
        $cartItem = Cart::findOrFail($id);

        // Get the product associated with the cart item
        $product = Product::findOrFail($cartItem->product_id);

        // Update the product quantity
        $product->quantity += $cartItem->quantity;
        $product->save();

        // Delete the cart item
        $cartItem->delete();

        // Redirect back to the cart page
        return redirect()->route('cart.index');
    }
}