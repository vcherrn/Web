<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CartController extends Controller
{


    public function store(Request $request)
    {
            $id = $request->input('id');
            $count = $request->input('count');
            $side = $request->input('side');
           
            $product_cart = Cart::where('prosthes_id','=', (int)$id)->where('side', '=', $side)->where('user_id','=',Auth::id())->exists();

            if(!$product_cart ){
                Cart::create([
                    'user_id'=>Auth::id(),
                    'prosthes_id'=>(int)$id,
                    'count'=> $count,
                    'side'=> $side,
                ]);
            }
    }
    public function constructor_store(Request $request){
        $products = $request->input('products');
        $specifications = $request->input('p_specifications');
        foreach ($products as $key => $value) {
            $product_cart = Cart::where('prosthes_id','=', $value['id'])->where('side', '=', $value['side'])->where('user_id','=',Auth::id())->exists();
            if(!$product_cart ){
                
                Cart::create([
                    'user_id'=>Auth::id(),
                    'prosthes_id'=>(int)$value['id'],
                    'count'=>1,
                    'side'=>$value['side'],
                    'specification'=> !empty($specifications[$key]) ? json_encode($specifications[$key]) : null
                ]);
            }
            
        }
       
    }

    public function destroy(int $id)
    {
        DB::statement('CALL delete_product_from_user_cart(?, ?)', [$id, Auth::id()]);
        // Cart::query()->where('id','=',$id)->where('user_id','=',Auth::id())->delete();
    }

    public function cartUpdate(Request $request)
    {
        $count = $request->input('count');
        $products = $request->input('products');
       
        foreach($products as $key => $value){
            DB::table('carts')
                ->where('id',$value['id'])
                ->where('user_id',Auth::id())
                ->update(['count'=>(int)$value['count'], 'side'=>$value['side'] ]);
        }
    }
}
