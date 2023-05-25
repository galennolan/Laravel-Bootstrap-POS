<?php

namespace App\Http\Controllers;

use App\Pengembalian;
use App\OrderDetail;
use DB;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        $returns = Pengembalian::with('orderDetail')->latest()->get();

        return view('returns.index', compact('returns'));
    }

    public function create()
    {
        $orderDetails = OrderDetail::select('order_details.id', 'customers.name as customer_name','products.name as product_name','order_details.quantity as product_qty')
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->join('products','order_details.product_id', '=', 'products.id')
        ->get();
        return view('returns.create', compact('orderDetails'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'order_detail_id' => 'required|exists:order_details,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Calculate the refund amount (80% of the product price)
        $orderDetail = OrderDetail::findOrFail($request->order_detail_id);
        $refundAmount = $orderDetail->product->selling_price * $request->quantity * 0.8;

        // Create a new return record
        $return = new Pengembalian();
        $return->order_detail_id = $request->order_detail_id;
        $return->quantity = $request->quantity;
        $return->save();

        // Return the refund amount to the customer (pseudo code)
        $customer = $orderDetail->order->customer;
        $customer->balance += $refundAmount;
        $customer->save();

        return redirect()->route('returns.index')->with('success', 'Return request submitted successfully.');
    }
}
