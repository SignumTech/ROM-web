<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
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
            "p_name" => "required | string",
            "price" => "required | float",
            "description" => "required | string",
            "size" => "required | string",
            "color" => "required | string",
            "p_image" => "required | string",
            "brand_id" => "required | integer",
            "cat_id" => "required | integer",
        ]);
        $product = new Product;
        $product->p_name = $request->p_name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->size = json_encode($request->size);
        $product->color = json_encode($request->color);
        $product->p_image = json_encode($request->p_image);
        $product->brand_id = $request->brand_id;
        $product->cat_id = $request->brand_id;

        $product->save();

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        
        return $product;
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
            "p_name" => "required | string",
            "price" => "required | float",
            "description" => "required | string",
            "size" => "required | string",
            "color" => "required | string",
            "p_image" => "required | string",
            "brand_id" => "required | integer",
            "cat_id" => "required | integer",
        ]);
        $product = Product::find($id);
        $product->p_name = $request->p_name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->size = json_encode($request->size);
        $product->color = json_encode($request->color);
        $product->p_image = json_encode($request->p_image);
        $product->brand_id = $request->brand_id;
        $product->cat_id = $request->brand_id;

        $product->save();

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return $product;
    }

    public function productsByCategory($id)
    {
        $products = Product::where('cat_id', $id)->get();
        
        return $products;
    }
}
