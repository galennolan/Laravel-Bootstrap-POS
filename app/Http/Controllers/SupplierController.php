<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::latest()->get();

        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
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
            'name'      => 'required|unique:suppliers|max:255',
            'email'     => 'required|email|unique:suppliers|max:255',
            'address'   => 'required',
            'phone'     => 'required|numeric|unique:suppliers',
            'shop_name' => 'nullable|unique:suppliers',
            'new_photo'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->photo) {
            $img_name = time() . '.' . $request->photo->getClientOriginalExtension();
            $path = public_path('asset/img/supplier/') . $img_name;

            $img = Image::make($request->photo->getRealPath());
            $img->resize(300, 200);
            $img->save($path);

        } else {
            $img_name = null;
        }

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->photo = $img_name;
        $supplier->shop_name = $request->shop_name;
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name'      => 'required|unique:suppliers,name,' . $supplier->id,
            'email'     => 'required|email|unique:suppliers,email,' . $supplier->id,
            'address'   => 'required',
            'phone'     => 'required|numeric|unique:suppliers,phone,' . $supplier->id,
            'shop_name' => 'nullable|unique:suppliers,shop_name,' . $supplier->id,
            'new_photo'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->new_photo) {
            // Delete Old Photo
            if ($supplier->photo) {
                @unlink(public_path('asset/img/supplier/') . $supplier->photo);
            }

            $img_name = time() . '.' . $request->new_photo->getClientOriginalExtension();
            $path = public_path('asset/img/supplier/') . $img_name;

            $img = Image::make($request->new_photo->getRealPath());
            $img->resize(300, 200);
            $img->save($path);

        } else {
            $img_name = $supplier->photo;
        }

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->shop_name = $request->shop_name;
        $supplier->photo = $img_name;
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $photo = $supplier->photo;
        if ($photo) {
            @unlink(public_path('asset/img/supplier/') . $photo);
        }
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}