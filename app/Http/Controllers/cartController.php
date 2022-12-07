<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Inventory;
class cartController extends Controller
{
    public function addToCartNew(Request $request){
        $this->validate( $request, [
            "product_id" => "required",
            "color_id" => "required",
            "size_id" => "required"
        ]);
        $inventory = Inventory::where('p_id', $request->product_id)
                            ->where('color_id', $request->color_id)
                            ->where('size_id', $request->size_id)
                            ->first();
        
        return (Auth::check())?$this->addAuthCart($inventory, $request):$this->addSessionCart($inventory, $request);

    }
    public function addAuthCart($inventory, $request){
        $cart = Cart::where('user_id', auth()->user()->id)->first();
        
        if($cart){
            $cart_item = CartItem::where('cart_id', $cart->id)
                                 ->where('inventory_id', $inventory->id)
                                 ->first();
            if($cart_item){
                $cart_item->quantity =  $cart_item->quantity + 1;
                $cart_item->save();
            }
            else{
                $new_item = new CartItem;
                $new_item->inventory_id = $inventory->id;
                $new_item->cart_id = $cart->id;
                $new_item->quantity = 1;
                $new_item->save();
            }
            
        }
        else{
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->save();

            $new_item = new CartItem;
            $new_item->inventory_id = $inventory->id;
            $new_item->cart_id = $cart->id;
            $new_item->quantity = 1;
            $new_item->save();
        }
        return response(200);
    }

    public function addSessionCart($inventory, $request){
        if($request->session()->has('cart')) {
                
            $cartData = $request->session()->get('cart');
            
            $invIds = array_column($cartData, 'inventory_id');
            
            if(in_array($inventory->id, $invIds)){
                $index = array_search($inventory->id, array_column($cartData, 'inventory_id'));
                $cartData[$index]['quantity'] = $cartData[$index]['quantity']+1;
                $request->session()->put('cart', $cartData);
            }
            else{
                $data = [];
                $data['inventory_id'] = $inventory->id;
                $data['quantity'] = 1;
                $data['p_id'] = $inventory->p_id;
                $data['color_id'] = $inventory->color_id;
                $data['size_id'] = $inventory->size_id;
                $data['id'] = 0; 
                $data['cart_id'] = 0;
                array_push($cartData, $data);
                $request->session()->put('cart', $cartData);
            }
            return response(200);
        }
        else{
            $cartData = [];
            $data = [];
            $data['inventory_id'] = $inventory->id;
            $data['quantity'] = 1;
            $data['p_id'] = $inventory->p_id;
            $data['color_id'] = $inventory->color_id;
            $data['size_id'] = $inventory->size_id;
            $data['id'] = 0; 
            $data['cart_id'] = 0;

            array_push($cartData, $data);
            $request->session()->put('cart', $cartData);
            return response(200);
        }
    }

    public function getCartNew(Request $request){

        return (Auth::check())?$this->getDBcart($request):$this->getSessionCart($request);

    }

    public function getDBcart($request){
        $data = [];
        $index = 0;
        if($request->session()->has('cart')){
            $cart = $this->migrateSessionCart($request->session()->get('cart'));
            
            $cart_items = CartItem::where('cart_id', $cart->id)->get();
            $request->session()->forget('cart');
            return $this->getFinalCartData($cart_items);
        }
        else{
            $cart = Cart::where('user_id', auth()->user()->id)->first();
            $cart_items = CartItem::where('cart_id', $cart->id)->get();
            return $this->getFinalCartData($cart_items);
        }
    }

    public function getFinalCartData($cart_items){
        $data = [];
        if(!$cart_items)
        {
            return [];
        }
        foreach($cart_items as $item){
            
            $item_detail = Inventory::join('products', 'inventories.p_id', '=', 'products.id')
                            ->join('sizes', 'inventories.size_id', '=', 'sizes.id')
                            ->join('product_colors', 'inventories.color_id', '=', 'product_colors.id')
                            ->join('product_images', 'product_colors.id', '=', 'product_images.color_id')
                            ->where('inventories.id', $item['inventory_id'])
                            ->select('products.p_name', 'product_colors.color', 'sizes.size', 'products.price', 'product_images.p_image', 'products.promotion_status', 'inventories.p_id')
                            ->first();
            $item_detail->quantity = $item['quantity'];
            $item_detail->item_id = $item['id'];
            $item_detail->cart_id = $item['cart_id'];                 
            array_push($data,$item_detail);
        }
        return $data;
    }

    public function getSessionCart($request){
        $cart_items = $request->session()->get('cart');
        
        return $this->getFinalCartData($cart_items);
    }

    public function migrateSessionCart($cart){
        $item = [];
        $cart_detail = Cart::where('user_id',auth()->user()->id)->first();
        
        if($cart_detail){
            foreach($cart as $c){
                $item = CartItem::where('inventory_id', $c['inventory_id'])
                                 ->where('cart_id', $cart_detail->id)
                                 ->first();
                if($item){
                    $item->quantity = $item->quantity + $c['quantity'];
                    $item->save();
                }
                else{
                    $item = new CartItem;
                    $item->cart_id = $cart_detail->id;
                    $item->inventory_id = $c['inventory_id'];
                    $item->quantity = $c['quantity'];
                    $item->save();
                }
            }
            return $cart_detail;
        }
        else{
            $cart_detail = new Cart;
            $cart_detail->user_id = auth()->user()->id;
            $cart_detail->save();

            foreach($cart as $c){
                $item = new CartItem;
                $item->cart_id = $cart_detail->id;
                $item->inventory_id = $c['inventory_id'];
                $item->quantity = $c['quantity'];
                $item->save();
            }

            return $cart_detail;
        }
    }

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
            $product['promotion_status'] = $request->product['promotion_status'];
            if($request->product['promotion_status'] == 'FLASH SALE'){
                $product['new_price'] = $request->product['price'] - ($request->product['price']*$request->product['discount']/100);
            }
            else{
                $product['new_price'] = $request->product['price'];
            }
            $product['p_id'] = $request->product['id'];
            $product['color'] = $request['color'];
            $product['size'] = $request['size'];
            $product['quantity'] = $request['quantity'];

            $cart = Cart::where('user_id', auth()->user()->id)
                        ->where('cart_status', 'ACTIVE')
                        ->first();
            if($cart){
                $cart_items = json_decode($cart->items);
                $isSameProduct = false;
                foreach($cart_items as $cd){
                    if($cd->p_id == $product['p_id'] && $cd->color == $product['color'] && $cd->size == $product['size']){
                        $cd->quantity += 1;
                        $isSameProduct = true;
                        break;
                    }
                }
                if($isSameProduct == false){
                    array_push($cart_items,$product);
                }
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
        else{
            if($request->session()->has('cart')) {
                $product = [];
                $product['p_name'] = $request->product['p_name'];
                $color = $request['color'];

                $product['p_image'] = json_decode($request->product['p_image'])->$color[0];
                $product['price'] = $request->product['price'];
                $product['promotion_status'] = $request->product['promotion_status'];
                if($request->product['promotion_status'] == 'FLASH SALE'){
                    $product['new_price'] = $request->product['price'] - ($request->product['price']*$request->product['discount']/100);
                }
                else{
                    $product['new_price'] = $request->product['price'];
                }
                $product['p_id'] = $request->product['id'];
                $product['color'] = $request['color'];
                $product['size'] = $request['size'];
                $product['quantity'] = $request['quantity'];
                $cartData = json_decode($request->session()->get('cart'));
                $isSameProduct = false;
                foreach($cartData as $cd){
                    if($cd->p_id == $product['p_id'] && $cd->color == $product['color'] && $cd->size == $product['size']){
                        $cd->quantity += 1;
                        $isSameProduct = true;
                        break;
                    }
                }
                if($isSameProduct == false){
                    array_push($cartData,$product);
                }
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
                $product['promotion_status'] = $request->product['promotion_status'];
                if($request->product['promotion_status'] == 'FLASH SALE'){
                    $product['new_price'] = $request->product['price'] - ($request->product['price']*$request->product['discount']/100);
                }
                else{
                    $product['new_price'] = $request->product['price'];
                }
                $product['p_id'] = $request->product['id'];
                $product['color'] = $request['color'];
                $product['size'] = $request['size'];
                $product['quantity'] = $request['quantity'];
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
                    foreach($cart_db as $cd){
                        foreach($cartData as $cart_data){
                            if($cd->p_id == $cart_data->p_id && $cd->color == $cart_data->color && $cd->size == $cart_data->size){
                                $cd->quantity += 1;
                                array_splice($cartData, array_search($cart_data, $cartData), 1);
                            }
                        }

                    }
                    if(count($cartData)>0){
                        $cart_db = array_merge($cart_db,$cartData);
                    }
        
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
                return response("No items in cart", 422);
            }
        }
    }

    public function editCart(Request $request){
        $this->validate( $request, [
            "product" => "required",
            "color" => "required",
            "size" => "required",
            "index" => "required",
        ]);

        if (Auth::check()){
            $cart = Cart::where('user_id', auth()->user()->id)
                            ->where('cart_status', 'ACTIVE')
                            ->first();
            $cart_items = json_decode($cart->items);
            //$new_item = $cart_items[$request->index];
            
            $cart_items[$request->index]->size = $request->size;
            $cart_items[$request->index]->color = $request->color;
            $cart->items = json_encode($cart_items);
            $cart->save();
            
            return $cart;
        }
        else{
            $cartData = json_decode($request->session()->get('cart'));
            //$cart_items = $cartData[$request->index];
            $cartData[$request->index]->size = $request->size;
            $cartData[$request->index]->color = $request->color;
            $request->session()->put('cart', json_encode($cartData));

            return response('',200);
        }
    }

    public function updateCart(Request $request, $id){
        $this->validate($request, [
            "items" => "required"
        ]);

        $invData = [];
        $items = $request->items;
        
        foreach($items as $item){
            $invCheck = Inventory::where('p_id', $item['p_id'])
                                 ->where('color', $item['color'])
                                 ->where('size', $item['size'])
                                 ->first();
            if($invCheck->quantity < $item['quantity']){
                $invData[$item['p_id']]['err'] = 'Only '.$invCheck->quantity.' are available';
                $invData[$item['p_id']]['invError'] = true;
            }
        }

        if(count($invData) > 0){
            return response($invData, 422);
        }
        else{
            $cart = Cart::find($id);
            $cart->items = json_encode($request->items);
            $cart->save();

            return $cart;            
        }

    }

    public function updateMobCart(Request $request, $id){
        $this->validate($request, [
            "items" => "required"
        ]);

        $invData = [];
        $items = $request->items;
        
        foreach(json_decode($items) as $item){
            $invCheck = Inventory::where('p_id', $item->p_id)
                                 ->where('color', $item->color)
                                 ->where('size', $item->size)
                                 ->first();
            if($invCheck->quantity < $item->quantity){
                $invData[$item->p_id]['err'] = 'Only '.$invCheck->quantity.' are available';
                $invData[$item->p_id]['invError'] = true;
            }
        }

        if(count($invData) > 0){
            return response($invData, 422);
        }
        else{
            $cart = Cart::find($id);
            $cart->items = json_encode(json_decode($request->items));
            $cart->save();

            return $cart;            
        }

    }

    public function deleteItem(Request $request){
        $this->validate($request, [
            "index" => "required"
        ]);
        
        if (Auth::check()){
            $cart = Cart::where('user_id', auth()->user()->id)
                            ->where('cart_status', 'ACTIVE')
                            ->first();
            $cart_items = json_decode($cart->items);
            
            array_splice($cart_items, $request->index, 1);
            $cart->items = json_encode($cart_items);
            $cart->save();
            return $cart;
        }
        else{
            $cartData = json_decode($request->session()->get('cart'));
            array_splice($cartData, $request->index, 1);

            $request->session()->put('cart', json_encode($cartData));
            $data = [];
            $data['items'] = $request->session()->get('cart');
            return $data;
        }

    }

    public function getMobCart(Request $request){
        $this->validate($request, [
            "items" => "required"
        ]);
        $cartData = json_decode($request->items);
        if(count($cartData)>0){
                
                $cart = Cart::where('user_id', auth()->user()->id)
                            ->where('cart_status', 'ACTIVE')
                            ->first();
                if($cart){
                    $cart_db = json_decode($cart->items);
                    foreach($cart_db as $cd){
                        foreach($cartData as $cart_data){
                            if($cd->p_id == $cart_data->p_id && $cd->color == $cart_data->color && $cd->size == $cart_data->size){
                                $cd->quantity += 1;
                                array_splice($cartData, array_search($cart_data, $cartData), 1);
                            }
                        }

                    }
                    if(count($cartData)>0){
                        $cart_db = array_merge($cart_db,$cartData);
                    }
        
                    $cart->items = json_encode($cart_db);
                    $cart->save();
                    
                    return $cart;
                }
                else{
                    $cart = new Cart;
                    $cart->items = json_encode($cartData);
                    $cart->user_id = auth()->user()->id;
                    $cart->save();
                    
                    return $cart;
                }
                
            }
            else{
                $cart = Cart::where('user_id', auth()->user()->id)
                            ->where('cart_status', 'ACTIVE')
                            ->first();
                return $cart;
            }
        
        return $cart;
    }

    public function syncCart(Request $request){
        $this->validate($request, [
            "items" => "required",
        ]);
        $items = json_decode($request->items);
        $cart = Cart::where('user_id', auth()->user()->id)->first();
        if($cart){
            foreach($items as $item){
                $inv = Inventory::where('p_id', $item->p_id)
                                ->where('size_id', $item->size_id)
                                ->where('color_id', $item->color_id)
                                ->first();
                $cartItem = CartItem::where('cart_id', $cart->id)
                                     ->where('inventory_id', $inv->id)
                                     ->first();
                if($cartItem){
                    $cartItem->quantity = $cartItem->quantity + $item->quantity;
                    $cartItem->save();
                }
                else{
                    $cartItem = new CartItem;
                    $cartItem->cart_id = $cart->id;
                    $cartItem->inventory_id = $inv->id;
                    $cartItem->quantity = $item->quantity;
                    $cartItem->save();
                }
            }
        }
        else{
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->cart_status = 'ACTIVE';
            $cart->save();

            foreach($items as $item){
                $cartItem = new CartItem;
                $cartItem->cart_id = $cart->id;
                $cartItem->inventory_id = $inv->id;
                $cartItem->quantity = $item->quantity;
                $cartItem->save();
            }
        }
        
        return $cart;
    }


}
