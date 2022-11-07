<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Wishlist;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Image;
use Storage;

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function productsByCategory($id)
    {
        $products = Product::where('cat_id', $id)
                           ->where('p_status', 'PUBLISHED')
                           ->where('promotion_status', 'REGULAR')
                           ->get();
        foreach($products as $product){
            if(Auth::check()){
                $item = Wishlist::where('p_id',$product->id)
                                ->where('user_id', auth()->user()->id)
                                ->first();
                if($item){
                $product->wishlist = true;
                }
                else{
                $product->wishlist = false;
                }
            }
            else{
                $product->wishlist = false;
            }

        }
        return $products;
    }

    public function productsAuthByCategory($id)
    {
        $products = Product::where('cat_id', $id)
                           ->where('p_status', 'PUBLISHED')
                           ->where('promotion_status', 'REGULAR')
                           ->get();
        foreach($products as $product){
            if(Auth::check()){
                $item = Wishlist::where('p_id',$product->id)
                                ->where('user_id', auth()->user()->id)
                                ->first();
                if($item){
                $product->wishlist = true;
                }
                else{
                $product->wishlist = false;
                }
            }
            else{
                $product->wishlist = false;
            }

        }
        return $products;
    }

    public function getProductsList(){
        $products = Product::all();
        foreach($products as $product){
            $product->stock = Inventory::where('p_id', $product->id)->sum('quantity');
        }

        return $products;                
    }

    public function getColorInventory($id){

        $colorData = [];
        $c_index = 0;
        $colors = Inventory::where('p_id', $id)->get()->groupBy('color');
        $product = Product::find($id);
        foreach($colors as $color){
            $s_index = 0;
            $current_color = '';
            foreach($color as $c){
                $colorData[$c_index]['color'] = $c->color;
                $current_color = $c->color;
                $colorData[$c_index]['sizes'][$s_index]['size'] = $c->size;
                $colorData[$c_index]['sizes'][$s_index]['quantity'] = $c->quantity;
                $s_index++;
            }
            
            //dd(collect(json_decode($product->p_image))[$current_color]);
            $colorData[$c_index]['pictures'] = collect(json_decode($product->p_image))[$current_color];
            
            $c_index++;
            
        }
        return $colorData;
    }

    public function getInventory($id){
        $inventory = Inventory::where('p_id', $id)->get()->groupBy('color');

        return $inventory;
    }

    public function productFilters($cat_id){
        $products = Product::where('cat_id', $cat_id)
                            ->where('p_status', 'PUBLISHED')
                            ->where('promotion_status', 'REGULAR')
                            ->get();
        $sizes = [];
        
        foreach($products as $product){
            //dd($product->sizes);
            $sizes = array_unique(array_merge($sizes,json_decode($product->sizes)));
        }
        return $sizes;
    }

    public function filterData(Request $request){
        $this->validate($request, [
            "max" => "required",
            "min" => "required",
            "cat_id" => "required"
        ]);
        $data = [];
        $products = Product::where('cat_id', $request->cat_id)
                            ->where('p_status', 'PUBLISHED')
                            ->where('promotion_status', 'REGULAR')
                            ->where('price', '<=', $request->max)
                            ->where('price', '>=', $request->min)
                            ->get();

        if(count($request->sizeData) > 0){
            foreach($products as $product){
                foreach(json_decode($product->sizes) as $size){
                    if(in_array($size, $request->sizeData)){
                        array_push($data, $product);
                        break;
                    }
                }

            } 
            return $data;           
        }
        else{
            return $products;
        }

        
    }

    public function filterMobData(Request $request){
        $this->validate($request, [
            "max" => "required",
            "min" => "required",
            "cat_id" => "required"
        ]);
        $request->sizeData = json_decode($request->sizeData);
        $data = [];
        $products = Product::where('cat_id', $request->cat_id)
                            ->where('p_status', 'PUBLISHED')
                            ->where('promotion_status', 'REGULAR')
                            ->where('price', '<=', $request->max)
                            ->where('price', '>=', $request->min)
                            ->get();
        foreach($products as $product){
            if(Auth::check()){
                $item = Wishlist::where('p_id',$product->id)
                                ->where('user_id', auth()->user()->id)
                                ->first();
                if($item){
                $product->wishlist = true;
                }
                else{
                $product->wishlist = false;
                }
            }
            else{
                $product->wishlist = false;
            }
        }
        if(count($request->sizeData) > 0){
            foreach($products as $product){
                foreach(json_decode($product->sizes) as $size){
                    if(in_array($size, $request->sizeData)){
                        array_push($data, $product);
                        break;
                    }
                }

            } 
            return $data;           
        }
        else{
            return $products;
        }
    }

    public function filterMobAuthData(Request $request){
        $this->validate($request, [
            "max" => "required",
            "min" => "required",
            "cat_id" => "required"
        ]);
        $request->sizeData = json_decode(json_encode($request->sizeData));
        $data = [];
        $products = Product::where('cat_id', $request->cat_id)
                            ->where('p_status', 'PUBLISHED')
                            ->where('promotion_status', 'REGULAR')
                            ->where('price', '<=', $request->max)
                            ->where('price', '>=', $request->min)
                            ->get();
        foreach($products as $product){
            if(Auth::check()){
                $item = Wishlist::where('p_id',$product->id)
                                ->where('user_id', auth()->user()->id)
                                ->first();
                if($item){
                $product->wishlist = true;
                }
                else{
                $product->wishlist = false;
                }
            }
            else{
                $product->wishlist = false;
            }
        }
        if(count($request->sizeData) > 0){
            foreach($products as $product){
                
                foreach(json_decode($product->sizes) as $size){
                    if(in_array($size, $request->sizeData)){
                        array_push($data, $product);
                        break;
                    }
                }
            } 
            return $data;           
        }
        else{
            return $products;
        }
    }

    public function priceRange($cat_id){
        $max = Product::where('cat_id', $cat_id)
                            ->where('p_status', 'PUBLISHED')
                            ->where('promotion_status', 'REGULAR')
                            ->max('price');
        $min = Product::where('cat_id', $cat_id)
                        ->where('p_status', 'PUBLISHED')
                        ->where('promotion_status', 'REGULAR')
                        ->min('price');
        $data = [];
        $data['max'] = $max;
        $data['min'] = $min;

        return $data;
    }

    public function getFeatured($id){
        $data = [];
        $categories = Category::where('parent_id', $id)->get();
        foreach($categories as $category){
            $products = Product::where('featured', 'FEATURED')
                          ->where('cat_id', $category->id)
                          ->get();
            if(count($products)>0){
                foreach($products as $product){
                    array_push($data,$product);
                }
            }
            
        }
        
        return $data;
    }

    public function searchItems(Request $request){
        $this->validate($request, [
            "searchQuery" => "required"
        ]);
        $data = [];
        ///////categories/////////////
        $category = Category::where('cat_name', 'LIKE', '%'.$request->searchQuery.'%')->get();
        foreach($category as $cat){
            $products = Product::where('cat_id', $cat->id)->get()->toArray();
            if(count($products)>0){
                $data = array_merge($data,$products);
            }
            
        }

        //////products//////////////////
        $products = Product::where('p_name', 'LIKE', '%'.$request->searchQuery.'%')->get()->toArray();
        $data = array_merge($data, $products);

        return $data;
    }
}
