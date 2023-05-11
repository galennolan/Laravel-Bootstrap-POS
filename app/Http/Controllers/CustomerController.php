<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->get();

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|unique:customers|max:255',
            'email'   => 'required|email|unique:customers|max:255',
            'address' => 'required',
            'phone'   => 'required|numeric|unique:customers',
            'photo'   => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $img_name = time() . '.' . $request->photo->getClientOriginalExtension();
        $path = public_path('asset/img/customer/') . $img_name;

        $img = Image::make($request->photo->getRealPath());
        $img->resize(300, 200);
        $img->save($path);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->photo = $img_name;
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'    => 'required|max:255|unique:customers,name,' . $customer->id,
            'email'   => 'required|email|max:255|unique:customers,email,' . $customer->id,
            'address' => 'required',
            'phone'   => 'required|numeric|unique:customers,phone,' . $customer->id,
            'new_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->new_photo) {
            $img_name = time() . '.' . $request->new_photo->getClientOriginalExtension();
            $path = public_path('asset/img/customer/') . $img_name;

            $img = Image::make($request->new_photo->getRealPath());
            $img->resize(300, 200);
            $img->save($path);

            // Delete old photo from the server
            if ($customer->photo != null) {
                $old_photo = public_path('asset/img/customer/') . $customer->photo;
                if (file_exists($old_photo)) {
                    unlink($old_photo);
                }
            }
            $customer->photo = $img_name;
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        // Delete customer photo from the server
        if ($customer->photo != null) {
            $old_photo = public_path('asset/img/customer/') . $customer->photo;
            if (file_exists($old_photo)) {
                unlink($old_photo);
            }
        }

        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}