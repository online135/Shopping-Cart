<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    function show() {
        
        $imageUrl = asset('images/orange01.jpg');

        return view('product.show', [
            'imageUrl' => $imageUrl
        ]);
    }
}
