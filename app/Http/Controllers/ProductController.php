<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index() 
    {
        $products = $this->getProducts();

        return view('product.index', [
            'products' => $products
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
        return redirect()->route('products.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function show($id, Request $request) 
    {
        $products = $this->getProducts();

        $index = $id - 1;
        if ($index < 0 || $index >= count($products)) {
            abort(404);
        } 

        $product = $products[$index];

        return view('product.show', [
            'product' => $product
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
        $products = $this->getProducts();

        $index = $id - 1;
        if ($index < 0 || $index >= count($products)) {
            abort(404);
        } 

        $product = $products[$index];

        return view('product.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $products = $this->getProducts();

        $index = $id - 1;
        if ($index < 0 || $index >= count($products)) {
            abort(404);
        } 

        $product = $products[$index];

        return redirect()->route('products.index', ['product' => $product['id']]);
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
     * Without Model, get Products data from Array
     *
     * 
     * @return Array
     */
    private function getProducts() 
    {
        return [
            [
                "id" => 1,
                "imageUrl" => asset('images/orange01.jpg')
            ],
            [
                "id" => 2,
                "imageUrl" => asset('images/apple01.jpg')
            ]
        ];
    }
}
