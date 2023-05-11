<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();

        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $request->validate( [
            'name' => 'required|unique:categories',
        ] );

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show( Category $category )
    {
        return view('category', [
            'category' => $category,
        ]);
    }

    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Category $category )
    {
        $request->validate( [
            'name' => 'required|unique:categories,name,' . $category->id,
        ] );

        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy( Category $category )
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}