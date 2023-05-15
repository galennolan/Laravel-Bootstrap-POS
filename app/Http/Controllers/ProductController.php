<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Supplier;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'supplier')->latest()->get();
       
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'new_photo'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'root' => 'required|string|max:255',
            'buying_date' => 'required|date_format:Y-m-d'
        ]);
   
        if ($request->photo) {
            $img_name = time() . '.' . $request->photo->getClientOriginalExtension();
            $path = public_path('asset/img/product/') . $img_name;

            $img = Image::make($request->photo->getRealPath());
            $img->resize(300, 200);
            $img->save($path);

        } else {
            $img_name = null;
        }

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->quantity = $request->quantity;
        $product->photo = $img_name;
        $product->root = $request->root;
        $product->buying_date = $request->buying_date;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $suppliers = Supplier::all();
        
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'code' => 'required|unique:products,code,'.$id,
        ]);
        
        $product = Product::find($id);
        $product->name = $request->name;
        $product->code = $request->code;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;        
        $product->supplier_id = $request->supplier_id;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        
        
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('/products');
    }
}
