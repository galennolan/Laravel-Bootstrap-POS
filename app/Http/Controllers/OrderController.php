<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order_submit(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|integer',
            'paid' => 'required|numeric',
            'paidBy' => 'required',
        ]);

        $due = $request->total - $request->paid;

        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->quantity = $request->quantity;
        $order->sub_total = $request->sub_total;
        $order->vat = $request->vat;
        $order->total = $request->total;
        $order->paid = $request->paid;
        $order->due = $due;
        $order->paidBy = $request->paidBy;
        $order->date = date('Y-m-d');
        $order->month = date('F');
        $order->year = date('Y');
        $order->save();

        $order_id = $order->id;

        $cartItems = Cart::all();
        foreach ($cartItems as $cartItem) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order_id;
            $orderDetail->product_id = $cartItem->product_id;
            $orderDetail->quantity = $cartItem->quantity;
            $orderDetail->price = $cartItem->product->selling_price;
            $orderDetail->sub_total = $cartItem->product->selling_price * $cartItem->quantity;
            $orderDetail->save();

            Product::where('id', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
        }

        Cart::truncate();

        return redirect()->route('orders.all')->with('success', 'Order submitted successfully!');
    }

    public function today_order()
    {
        $date = date('Y-m-d');
        $orders = Order::with('customer')->where('date', $date)->latest()->get();

        return view('orders.today', compact('orders'));
    }

    public function view_order_details($id)
    {
        $orders = OrderDetail::with('product')->where('order_id', $id)->get();

        $customerOrder = Order::with('customer')->where('id', $id)->first();

        return view('orders.details', compact('orders', 'customerOrder'));
    }

    public function all_orders()
    {
        $orders = Order::with('customer')->latest()->get();

        return view('orders.all', compact('orders'));
    }
}