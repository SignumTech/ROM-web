<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\ProductImage;

class wishlistController extends Controller
{
    public function addToWishlist($id){
        $wishlist = new Wishlist;
        $wishlist->p_id = $id;
        $wishlist->user_id = auth()->user()->id;
        $wishlist->save();

        return $wishlist;
    }

    public function getMyWishlist(){
        $wishlists = Wishlist::join('products', 'wishlists.p_id', '=', 'products.id')
                            ->where('user_id', auth()->user()->id)
                            ->get();
        foreach($wishlists as $wishlist){
            $wishlist->p_image = ProductImage::where('product_id', $wishlist->id)->first()->p_image;
        }
        return $wishlists;
    }

    public function removeFromWishlist($id){
        $item = Wishlist::where('p_id', $id)
                        ->where('user_id', auth()->user()->id)
                        ->first();
        $item->delete();
        return $item;
    }
}
