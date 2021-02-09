<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private $products;

    public function __construct()
    {
        $this->products = $this->getProducts();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {
        return view('product.index', [
            "products" => $this->products
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
        $diskName = "public";
        $name = $request->file('product_image')->getClientOriginalName();
        $path = $request->file('product_image')->storeAs(
            'products',
            $name,
            $diskName
        );
        $url = Storage::disk($diskName)->url($path);

        DB::table('products')->insert([
            'name' => $request->input('product_name'),
            'price' => $request->input('product_price'),
            'image_url' => $url
        ]);

        return redirect()->route('products.index');
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
        $index = $id - 1;
        if ( $index < 0 || $index >= count($this->products)){
            abort(404);
        }

        $product = $this->products[$index];

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
        $index = $id - 1;
        if ( $index < 0 || $index >= count($this->products)){
            abort(404);
        }

        $product = $this->products[$index];

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
        $index = $id - 1;
        if ( $index < 0 || $index >= count($this->products)){
            abort(404);
        }

        $product = $this->products[$index];

        return redirect()->route('products.edit', ['product' => $product['id']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('products.index');
    }

    /**
     * Get Products data from array
     *
     * 
     * @return \Illuminate\Http\Response
     */
    private function getProducts()
    {
        return [
            [
                "id" => 1,
                "name" => "Orange",
                "price" => 30,
                "imageUrl" => asset('images/orange01.jpg')
            ],
            [
                "id" => 2,
                "name" => "Apple",
                "price" => 20,
                "imageUrl" => asset('images/apple01.jpg')
            ]
        ];
    }
}
