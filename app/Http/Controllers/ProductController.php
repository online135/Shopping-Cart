<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    function show($id, Request $request) {
        
        $index = $id - 1;

        $products = [
            [
                'imageUrl' => asset('images/orange01.jpg')
            ],
            [
                'imageUrl' => asset('images/apple01.jpg')
            ]
        ];

        $product = $products[$index];

        return view('product.show', [
            'product' => $product
        ]);
    }
}
