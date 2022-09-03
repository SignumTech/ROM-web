<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cartController extends Controller
{
    public function addToCart(Request $request){
        $this->validate( $request, [
            "product" => "required",
            "color" => "required",
            "size" => "required"
        ]);
        if($request->hasCookie('cart')) {
            $product = [];
            $product['product'] = $request->product;
            $product['color'] = $request->color;
            $product['size'] = $request->size;

            $cartData = json_decode($request->cookie('cart'));
            array_push($cartData, $product);
            return $cartData;
        }
        else{
            $cartData = [];
        
            array_push($cartData,$product);
            return response('Added', 200)->cookie('cart', json_encode($cartData), 10080);
        }
    }

    public function getCart(Request $request){
        if($request->hasCookie('cart')) {
            return json_decode($request->cookie('cart'));
        }
    }
}
