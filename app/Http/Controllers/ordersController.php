<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
class ordersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::all();
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
        $cart = Cart::find($request->cart_id);
        $items = json_decode($cart->items);

        $order = new Order;
        $order->items = json_encode($items);

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

        $cart->delete();

        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Order::find($id);
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
        $this->validate($request, [
            'items' => 'required | string',
            'total' => 'required | double',
            'delivery_details' => 'required | string'
        ]);
        $order = Order::find($id);
        $order->items = json_encode($request->items);
        $order->order_no = 'to be determined';
        $order->total = $request->total;
        $order->order_status = 'PROCESSING';
        $order->user_id = auth()->user()->id;
        $order->delivery_details = $request->delivery_details;
        $order->save();

        return $order;
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

    public function getProcessing(){
        $order = Order::where('order_status', 'PROCESSING')->get();

        return $order;
    }

    public function getShipped(){
        $order = Order::where('order_status', 'SHIPPED')->get();

        return $order;
    }

    public function getDelivered(){
        $order = Order::where('order_status', 'DELIVERED')->get();

        return $order;
    }

    public function getMyOrders(){
        $orders = Order::where('user_id', auth()->user()->id)->get();
        $items = 0;
        $pic = null;
        foreach($orders as $order){
            $o_items = json_decode($order->items);
            foreach($o_items as $ot){
                $items = $items + $ot->quantity;
                if($pic == null){
                    $pic = $ot->p_image;
                }
            }
            $order->no_items = $items;
            $order->p_image = $pic;
            $items = 0;
        }
        return $orders;
    }

    public function getMyOrdersStatus($status){
        $orders = Order::where('user_id', auth()->user()->id)
                        ->where('order_status', $status)->get();
        $items = 0;
        $pic = null;
        foreach($orders as $order){
            $o_items = json_decode($order->items);
            foreach($o_items as $ot){
                $items = $items + $ot->quantity;
                if($pic == null){
                    $pic = $ot->p_image;
                }
            }
            $order->no_items = $items;
            $order->p_image = $pic;
            $items = 0;
        }
        return $orders;
    }
}
