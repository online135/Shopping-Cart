<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {
        $products = DB::table('products')->get();

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

        DB::table('products')->insert($validatedData);

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
        $product = DB::table('products')->where('id', $id)->first();
        
        if (is_null($product)) {
            abort(404);
        }

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
        $product = DB::table('products')->where('id', $id)->first();

        if (is_null($product)) {
            abort(404);
        }
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
        $product = DB::table('products')->where('id', $id)->first();

        if (is_null($product)) {
            abort(404);
        }

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

        $affected = DB::table('products')
                ->where('id', $id)
                ->update($validatedData);

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
        $product = DB::table('products')->where('id', $id)->first();

        if (is_null($product)) {
            return redirect()->route('products.index');
        }

        $product = DB::table('products')->where('id', $id)->delete();

        return redirect()->route('products.index');
    }
}
