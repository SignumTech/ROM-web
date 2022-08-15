<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
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
            'items' => 'required | string',
            'total' => 'required | double',
            'delivery_details' => 'required | string'
        ]);
        $order = new Order;
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
}
