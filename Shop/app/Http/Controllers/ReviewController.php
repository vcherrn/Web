<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Models\Prosthes;
use App\Models\ProsthesOrder;
use App\Models\Review;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ReviewController extends Controller
{
   
    public function index($id){
       
        $reviews = Review::where('prosthes_id','=',$id)->get();
        $users = User::all();
        $data = [
            'reviews' => $reviews,
            'users' => $users,
            'user_id' => Auth::id(),
        ];
        return $data;
    }
    public function store(Request $request)
    {
        $rate = $request->input('rate');
        $review = $request->input('review');
        $product_id = $request->input('product_id');
        $product_cart = Review::where('prosthes_id','=', $product_id)->where('user_id','=',Auth::id())->exists();
        if(!$product_cart ){
            Review::create([
                'user_id'=>Auth::id(),
                'prosthes_id'=>$product_id,
                'rate'=>$rate,
                'm_text'=>$review
            ]);
        }

        // return redirect()->route('dashboard');
    }

    
    public function hasPurchased(Request $request){
        $product_id = $request->input('product_id');
        
        $hasPurchased = Order::where('user_id', Auth::id())
        ->join('prosthes_orders', 'orders.id', '=', 'prosthes_orders.order_id')
        ->where('prosthes_orders.prosthes_id', $product_id)
        ->exists();
        return response()->json(['hasPurchased' => $hasPurchased]);
      
    }
    public function deleteReview($productID){
        Review::where('prosthes_id','=',(int)$productID)->where('user_id','=',Auth::id())->delete();
        
    }
    

   
}
