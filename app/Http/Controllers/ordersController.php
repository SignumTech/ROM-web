<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductColor;
use App\Models\Size;
use DB;
class ordersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'cart_id' => 'required | integer',
            'total' => 'required | numeric',
            'address' => 'required | integer'
        ]);
        try{
            DB::beginTransaction();
            $cart = Cart::find($request->cart_id);
            $items = CartItem::where('cart_id', $request->cart_id)->get();

            ////////////////////////////////////////////////
            $order = new Order;

            $latestOrder = Order::orderBy('created_at','DESC')->first();
            if($latestOrder){
                $order->order_no = '#'.str_pad($latestOrder->id + 1, 8, "0", STR_PAD_LEFT);
            }
            else{
                $order->order_no = '#'.str_pad(1, 8, "0", STR_PAD_LEFT);
            }

            $order->total = $request->total;
            $order->order_status = 'PROCESSING';
            $order->user_id = auth()->user()->id;
            $order->delivery_details = $request->address;
            $order->save();
            //////////update inventory//////////////////////
            foreach($items as $item){
                $inventory = Inventory::where('inventory_id', $item->inventory_id)
                                    ->lockForUpdate()->first();
                if($inventory->quantity < $item->quantity){
                    return response("Some of the items have been sold out", 422);
                }
                else{
                    $inventory->quantity -= $item->quantity;
                    $inventory->save();

                    $order_items = new OrderItem;
                    $order_items->order_id = $order->id;
                    $order_items->inventory_id = $item->inventory_id;
                    $order_items->quantity = $item->quantity;
                    $order_items->save();
                }
                
            }
            


            $cart->delete();
            DB::commit();
            return $order;
        }
        catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return response('Order Error', 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $data['order'] = Order::find($id);
        $orderItems = OrderItem::where('order_id', $id)->get();
        foreach($orderItems as $item){
            $inventory = Inventory::find($item->inventory_id);
            $product = Product::find($inventory->p_id);
            $item->p_name = $product->p_name;
            $item->promotion_status = $product->promotion_status;
            $item->size = Size::find($inventory->size_id)->size;
            $item->color = ProductColor::find($inventory->color_id)->color;
            $item->price = $product->price;
            $item->p_image = ProductImage::where('product_id', $product->id)
                                        ->where('color_id', $inventory->color_id)
                                        ->first()->p_image;
        }
        $data['order_items'] = $orderItems;
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return $order;
    }

    public function getMyOrders(){
        $orders = Order::where('user_id', auth()->user()->id)->get();
       
        
        foreach($orders as $order){
            $order->no_items = OrderItem::where('order_id', $order->id)->count();
            $order->p_image = OrderItem::join('inventories', 'order_items.inventory_id', '=', 'inventories.id')
                                       ->join('product_images', 'inventories.color_id', '=', 'product_images.color_id')
                                       ->where('order_items.order_id', $order->id)->first()->p_image;
            
        }
        return $orders;
    }

    public function getMyOrdersStatus($status){
        $orders = Order::where('user_id', auth()->user()->id)
                       ->where('order_status', $status)->get();
        
        
        foreach($orders as $order){
            $order->no_items = OrderItem::where('order_id', $order->id)->count();
            $order->p_image = OrderItem::join('inventories', 'order_items.inventory_id', '=', 'inventories.id')
                                       ->join('product_images', 'inventories.color_id', '=', 'product_images.color_id')
                                       ->where('order_items.order_id', $order->id)->first()->p_image;
            
        }
        return $orders;
    }


    public function repurchaseOrder(Request $request){
        $this->validate($request, [
            "order_id" => "required"
        ]);

        $order = Order::find($request->order_id);
        $cart = Cart::where('user_id', auth()->user()->id)
                    ->where('cart_status', 'ACTIVE')
                    ->first();
        
        
        if($cart){
            $cartData = json_decode($cart->items);
            $cart_db = json_decode($order->items);
            foreach($cart_db as $cd){
                foreach($cartData as $cart_data){
                    if($cd->p_id == $cart_data->p_id && $cd->color == $cart_data->color && $cd->size == $cart_data->size){
                        $cd->quantity += $cart_data->quantity;
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
            $cart->items = $order->items;
            $cart->user_id = auth()->user()->id;
            $cart->cart_status = "ACTIVE";
            $cart->save();
        }

        return $cart;
    }
 
}
