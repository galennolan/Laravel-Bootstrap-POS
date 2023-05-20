<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Customer;
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
        $customers = Customer::all();
        $cartItems = Cart::with('product')->get();
        $total = 0;
        $subtotalpr =0;
        //pemformatan cartitem
        foreach ($cartItems as $cartItem) {
            $cartItem->formatted_subtotal = $this->formatPrice($cartItem->product ? $cartItem->product->selling_price * $cartItem->quantity : 0);
            if ($cartItem->product) {
                $cartItem->product->formatted_selling_price = $this->formatPrice($cartItem->product->selling_price);
                $total += $cartItem->product->selling_price * $cartItem->quantity;
                $subtotalpr += $cartItem->quantity;
            }
        }
        //pemformatan produk
        foreach ($products as $product) {
            $product->formatted_selling_price = $this->formatPrice($product->selling_price);
        }

        $formattedTotal = $this->formatPrice($total);

        return view('cart.index', compact('products', 'cartItems', 'formattedTotal','customers','subtotalpr'));
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
        if ($request->has('customer_id')) {
            $order->customer_id = $request->input('customer_id');
        }
        $order->quantity = $request->quantity;

        // Calculate the total price of the cart
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->selling_price * $cartItem->quantity;
        });
        $subtotalpr = $cartItems->sum('quantity');

        $order->total = $totalPrice;
        $order->vat = "2";
        $order->paid =  $totalPrice;
        $order->quantity = $subtotalpr;
        $order->paidBy = "cash";
        $order->date = date( 'Y-m-d' );
        $order->month = date( 'F' );
        $order->year = date( 'Y' );
        // Calculate the subtotal for each item in the cart
        $cartItems = $cartItems->map(function ($cartItem) {
            $cartItem->sub_total = $cartItem->product->selling_price * $cartItem->quantity;
            return $cartItem;
        });
    
        // Calculate the total subtotal of the cart
        $totalSubTotal = $cartItems->sum('sub_total');
        $order->sub_total = $totalSubTotal;
    
        $order->save();
    
        foreach ($cartItems as $cartItem) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id =  $order->id;
            $orderDetail->product_id = $cartItem->product_id;
            $orderDetail->quantity = $cartItem->quantity;
            $orderDetail->price = $cartItem->product->selling_price;
            $orderDetail->sub_total = $cartItem->product->selling_price * $cartItem->quantity;
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