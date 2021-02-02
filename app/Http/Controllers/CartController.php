<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    /**
     * Display a listing of the resource in the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function index(Request $request) {
        $cartItems = $this->getCartItems();

        return view('cart.index', [
            "cartItems" => $cartItems
        ]);
    }

    private function getCartFromCookie() {
        $cart = Cookie::get('cart');

        return $cart = (!is_null($cart)) ? json_decode($cart, true) : [];
    }

    private function getCartItems() {
        // [ id => quantity ]
        $cart = $this->getCartFromCookie();

        // [id]
        $productIds = array_keys($cart);

        // [
        //    [ product => value, quantity => value]
        //]
        $cartItems = array_map(function($productId) use ($cart) {
            $quantity = $cart[$productId];
            $product = $this->getProduct($productId);

            if ($product) {
                return [
                    "product" => $product,
                    "quantity" => $quantity
                ];
            } else {
                return null;
            }


        }, $productIds);

        return $cartItems;
    }

    private function getProduct($id) {
        $products = $this->getProducts();

        foreach($products as $product){
            if ($product['id'] == $id) {
                return $product;
            }
        }
        return null;
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
