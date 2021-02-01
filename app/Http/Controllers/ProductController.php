<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index() {
        
        $products = $this->getProducts();

        return view('product.index', [
            'products' => $products
        ]);
    }

    function show($id, Request $request) {
        
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

    private function getProducts() {
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
