<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Inventory;
class cartController extends Controller
{
    public function addToCart(Request $request){
        $this->validate( $request, [
            "product" => "required",
            "color" => "required",
            "size" => "required"
        ]);
        if (Auth::check()) {
            $product = [];
            $product['p_name'] = $request->product['p_name'];
            $color = $request['color'];

            $product['p_image'] = json_decode($request->product['p_image'])->$color[0];
            $product['price'] = $request->product['price'];
            $product['p_id'] = $request->product['id'];
            $product['color'] = $request['color'];
            $product['size'] = $request['size'];
            if($request->session()->has('cart')) {
                $cartData = json_decode($request->session()->get('cart'));
                array_push($cartData,$product);
                $cart = Cart::where('user_id', auth()->user()->id)
                            ->where('cart_status', 'ACTIVE')
                            ->first();
                if($cart){
                    $cart_items = json_decode($cart->items);
                    array_push($cart_items,$cartData);
                    $cart->items = json_encode($cart_items);
                    $cart->save();
                    $request->session()->forget('cart');
                    return $cart;
                }
                else{
                    $data = [];
                    array_push($data,$product);
                    $cart = new Cart;
                    $cart->items = json_encode($data);
                    $cart->user_id = auth()->user()->id;
                    $cart->save();
                    $request->session()->forget('cart');
                    return $cart;
                }
            }
            else{
                $cart = Cart::where('user_id', auth()->user()->id)
                            ->where('cart_status', 'ACTIVE')
                            ->first();
                if($cart){
                    $cart_items = json_decode($cart->items);
                    array_push($cart_items,$product);
                    $cart->items = json_encode($cart_items);
                    $cart->save();
                    return $cart;
                }
                else{
                    $data = [];
                    array_push($data,$product);
                    $cart = new Cart;
                    $cart->items = json_encode($data);
                    $cart->user_id = auth()->user()->id;
                    $cart->save();
                    return $cart;
                }
            }
        }
        else{
            if($request->session()->has('cart')) {
                $product = [];
                $product['p_name'] = $request->product['p_name'];
                $color = $request['color'];

                $product['p_image'] = json_decode($request->product['p_image'])->$color[0];
                $product['price'] = $request->product['price'];
                $product['p_id'] = $request->product['id'];
                $product['color'] = $request['color'];
                $product['size'] = $request['size'];
    
                $cartData = json_decode($request->session()->get('cart'));
                array_push($cartData,$product);
                $request->session()->put('cart', json_encode($cartData));
                return response('',200);
            }
            else{
                $cartData = [];
                $product = [];
                
                $product['p_name'] = $request->product['p_name'];
                $color = $request['color'];
                
                $product['p_image'] = json_decode($request->product['p_image'])->$color[0];
                $product['price'] = $request->product['price'];
                $product['p_id'] = $request->product['id'];
                $product['color'] = $request['color'];
                $product['size'] = $request['size'];
                array_push($cartData,$product);
                $request->session()->put('cart', json_encode($cartData));

                return response('',200);
            }
        }

    }

    public function getCart(Request $request){
        if (Auth::check()){
            if($request->session()->has('cart')){
                $cartData = json_decode($request->session()->get('cart'));
                $cart = Cart::where('user_id', auth()->user()->id)
                            ->where('cart_status', 'ACTIVE')
                            ->first();
                if($cart){
                    $cart_db = json_decode($cart->items);
                    array_push($cart_db,$cartData);
                    $cart->items = json_encode($cart_db);
                    $cart->save();
                    $request->session()->forget('cart');
                    return $cart;
                }
                else{
                    $cart = new Cart;
                    $cart->items = json_encode($cartData);
                    $cart->user_id = auth()->user()->id;
                    $cart->save();
                    $request->session()->forget('cart');
                    return $cart;
                }
                
            }
            else{
                $cart = Cart::where('user_id', auth()->user()->id)
                            ->where('cart_status', 'ACTIVE')
                            ->first();
                return $cart;
            }
            
        }
        else{
            if($request->session()->has('cart')){
                $data =[];
                $data['items'] = $request->session()->get('cart');
                return $data;
            }
            else{
                return [];
            }
        }
    }
}
