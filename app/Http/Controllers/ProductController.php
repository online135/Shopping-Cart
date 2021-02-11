<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index(Request $request)
    {
        $category_id = $request->input('category_id');
        if (!empty($category_id)) {
            $category = Category::find($category_id);
            $products = $category->products;
        } else {
            $products = Product::all();
        }

        return view('product.index', [
            "products" => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image']
        ]);
        unset($validatedData["image"]);

        if ($request->has('image')) {
            $diskName = "public";
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs(
                'products',
                $name,
                $diskName
            );
    
            // save path
            $validatedData["image_url"] = $path;

        $product = Product::create($validatedData);

        return redirect()->route('products.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function show(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        return view('product.show', [
            "product" => $product
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('product.edit', [
            "product" => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image']
        ]);
        unset($validatedData["image"]);

        if ($request->has('image')) {
            $diskName = "public";
            $disk = Storage::disk($diskName);
            // delete file
            if ($disk->exists($product->image_url)) {
                $disk->delete($product->image_url);
            }
    
            // save file
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs(
                'products',
                $name,
                $diskName
            );
    
            // save path
            $validatedData["image_url"] = $path;
        }

        $product->update($validatedData);

        return redirect()->route('products.edit', ['product' => $product->id ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return redirect()->route('products.index');
        }

        $diskName = "public";
        $disk = Storage::disk($diskName);
        if ($disk->exists($product->image_url)) {
            $disk->delete($product->image_url);
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
