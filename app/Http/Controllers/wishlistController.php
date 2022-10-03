<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class wishlistController extends Controller
{
    public function addToWishlist($id){
        $wishlist = new Wishlist;
        $wishlist->p_id = $id;
        $wishlist->user_id = auth()->user()->id;
        $wishlist->save();
    }

    public function getMyWishlist(){
        $wishlist = Wishlist::join('products', 'wishlist.p_id', '=', 'products.id')
                            ->where('user_id', auth()->user()->id)->get();
        return $wishlist;
    }
}
