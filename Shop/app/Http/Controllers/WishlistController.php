<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishlistStoreRequest;
use App\Http\Requests\WishlistUpdateRequest;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
class WishlistController extends Controller
{
    public function store(Request $request)
    {
            $id = $request->input('id');
            $product_cart = Wishlist::where('prosthes_id','=', $id)->where('user_id','=',Auth::id())->exists();
            if(!$product_cart ){
                Wishlist::create([
                    'user_id'=>Auth::id(),
                    'prosthes_id'=>(int)$id,
                ]);
            }
    }

    public function AddToCart(Request $request)
    {
            $id = $request->input('id');
            $product_cart = Cart::where('prosthes_id','=', $id)->where('user_id','=',Auth::id())->exists();
            if(!$product_cart ){
                Cart::create([
                    'user_id'=>Auth::id(),
                    'prosthes_id'=>(int)$id,
                ]);
            }
            $this->delete($id);
    }
    public function delete(int $id)
    {
        Wishlist::query()->where('prosthes_id','=',$id)->where('user_id','=',Auth::id())->delete();
    }
}
