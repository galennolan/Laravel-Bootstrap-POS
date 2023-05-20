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
        $orders = Order::with('customer') ->orderBy('date', 'asc')->latest()->get();

        return view('orders.all', compact('orders'));
    }
}