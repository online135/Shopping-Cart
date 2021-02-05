<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ProductImageRule;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:6',
            'product_price' => 'required|integer|min:0|max:9999',
            'product_image' => [
                'required',
                'string',
                new ProductImageRule
            ],
        ], [
            'required' => 'The :attribute field is required!!!!',
        ])->validateWithBag('products');

        //if ($validator->fails()) {
        //    return redirect('products/create')
        //                ->withErrors($validator)
        //                ->withInput();
        //}

        // images/apple01.jpg
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
