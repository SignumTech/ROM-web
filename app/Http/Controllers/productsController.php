<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;
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
        $this->validate($request, [
            "p_name" => "required | string",
            "description" => "required | string",
            "cat_id" => "required | integer",
            "price" => "required"
        ]);
        $product = new Product;
        $product->p_name = $request->p_name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->brand_id = $request->brand_id;
        $product->cat_id = $request->cat_id;
        $product->p_image = json_encode([]);

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
            "p_name" => "required",
            "cat_id" => "required",
            "price" => "required",
            "description" => "required"
        ]);

        $product = Product::find($id);
        $product->p_name = $request->p_name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->brand_id = $request->brand_id;
        $product->cat_id = $request->cat_id;

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
        $products = Product::where('cat_id', $id)
                           ->where('p_status', 'PUBLISHED')
                           ->get();
        
        return $products;
    }

    public function uploadProductPic(Request $request){
        $this->validate($request, [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2084',
        ]);
        //dd($request->cat_id);
        if($request->hasFile('photo')){
            
            //Get filename with the extention
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $thumbnailImage = Image::make($request->file('photo'));
            
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('photo')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload Image
            //$realPath = public_path().'\storage\products\\';
            $realPath = storage_path().'/app/public/products/';
            //$thumbnailPath = public_path().'\storage\productsThumb\\';
            $thumbnailPath = storage_path().'/app/public/productsThumb/';
            $thumbnailImage->save($realPath.$fileNameToStore);

            $thumbnailImage->resize(null, 320, function ($constraint){
                $constraint->aspectRatio();
            });
            $thumbnailImage->save($thumbnailPath.$fileNameToStore);
            
            $data = [];
            $data['fileName'] = $fileNameToStore;

            return $data; 
        }
        else{
            return response(422, "No file");
        }

    }

    public function insertColors(Request $request){
        $this->validate($request, [
            "colorData" => "required",
            "product_id" => "required"
        ]);
        $picturesData = [];
        $p_colors = [];
        $p_index = 0;
        $picAdded = false;
        foreach($request->colorData as $data){
            if(count($data['pictures']) == 0){
                return response("You need to insert atleast one picture to each color", 422);
            }
            
            foreach($data['sizes'] as $size){
                $inventory = new Inventory;
                $inventory->p_id = $request->product_id;
                $inventory->size = $size['size'];
                $inventory->color = $data['color'];
                $inventory->quantity = $size['quantity'];
                $inventory->save();
            }
            $picturesData[$data['color']] = $data['pictures'];
            if(!$picAdded){
                $picturesData['main'] = $data['pictures'][0];
                $picAdded = true;
            }
            $p_colors[$p_index] = $data['color'];
            $p_index++;
        }
        
        $product = Product::find($request->product_id);
        $product->p_image = json_encode($picturesData);
        $product->color = json_encode($p_colors);
        $product->save();

        return $product;
    }

    public function updateColors(Request $request){
        $this->validate($request, [
            "colorData" => "required",
            "product_id" => "required"
        ]);
        $picturesData = [];
        $picAdded = false;
        foreach($request->colorData as $data){
            if(count($data['pictures']) == 0){
                return response("You need to insert atleast one picture to each color", 422);
            }
            
            foreach($data['sizes'] as $size){
                $inventory = Inventory::updateOrCreate(
                    ['p_id' => $request->product_id],
                    ['size' => $size['size'], 'color' => $data['color'], 'quantity' => $size['quantity']]
                );
                
            }
            $picturesData[$data['color']] = $data['pictures'];

            if(!$picAdded){
                $picturesData['main'] = $data['pictures'][0];
                $picAdded = true;
            }
            
        }
        
        $product = Product::find($request->product_id);
        $product->p_image = json_encode($picturesData);
        $product->save();

        return $product;
    }

    public function deleteProductImage(Request $request){
        
        if(Storage::exists('public/products/'.$request->pic)){
            Storage::delete('public/products/'.$request->pic);
            Storage::delete('public/productsThumb/'.$request->pic);
            return response('successfully deleted', 200);
        }
        else{
            return response('Image doesnt exist', 422);
        }
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

    public function updateSizes(Request $request){
        $this->validate($request, [
            "sizes" => "required",
            "color" => "required",
            "product_id" => "required"
        ]);

        foreach($request->sizes as $size){
            
            $inv = Inventory::find($size['id']);
            if($inv){
                $inv->size = $size['size'];
                $inv->quantity = $size['quantity'];
                $inv->save();
            }
            else{
                $inv = new Inventory;
                $inv->p_id = $request->product_id;
                $inv->size = $size['size'];
                $inv->quantity = $size['quantity'];
                $inv->color = $request['color'];
                $inv->save();
            }
        }
       
        return $inv;
    }

    public function publishProduct(Request $request){
        $this->validate($request, [
            "p_id" => "required"
        ]);

        $product = Product::find($request->p_id);
        $product->p_status = "PUBLISHED";
        $product->save();
        return $product;
    }
}
