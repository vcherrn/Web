<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\ProsthesOrder;
use App\Models\Prosthes;
class OrderController extends Controller
{
    
    public function show_orders(Request $request) {
        
        $perPage = $request->input('perPage', 5);
        $paymentFilter = $request->input('paymentFilter');
        $statusFilter = $request->input('statusFilter');
        $search_string = $request->input('search_string');

        $orders = Order::query();

        if ($paymentFilter !== null) {
            $orders->where('ispayed', $paymentFilter);
        }

        if ($statusFilter !== null) {
            $orders->where('isactive', $statusFilter);
        }

        if($search_string !== null){
            $orders->where('id', $search_string);
        }
      
        $orders = $orders->paginate($perPage);
            
            if ($request->ajax()) {
                
                return view('Admin.orders', compact('orders'))->render();
            }

        return view('Admin.orders', [
            'orders' => $orders,
            'statusFilter' => $statusFilter,
            'paymentFilter' => $paymentFilter,
          
        ])->render();
  
           
    }

    public function store(Request $request)
    {
        $order = $request->all();
        $prostheses = Prosthes::all();
        $active_order = new Order([
            'user_id'=>Auth::id(),
            'isactive'=>1,
            'ispayed'=>$order['is_payed'],
            'payment_method'=>$order['payment_method'],
            'name'=>$order['name'],
            'surname'=>$order['surname'],
            'patronymic'=>$order['patronymic'],
            'country'=>$order['country'],
            'town'=>$order['town'],
            'area'=>$order['area'],
            'street'=>$order['street'],
            'house'=>$order['house'],
            'apartment'=>$order['apartment'],
            'telephone_number'=>$order['phone'],
            'user_email'=>$order['email'],
            'order_sum'=>$order['sum'],
            'message_text'=>$order['message_text'],
        ]);
        $active_order->save();


        $userCart =  Cart::where('user_id','=',Auth::id())->get();
        
        foreach($userCart as $key => $value) { 
            $prosthesis = Prosthes::find($value->prosthes_id);
            DB::table('prosthes_orders')->insert([
                'order_id'=>$active_order->id,
                'prosthes_id' => $value->prosthes_id,
                'count'=> $value->count,
                'side' => $value->side,
                'specification' => $value->specification,
                'price' => $prosthesis->price
            ]);
         }
        
         DB::table('carts')->where('user_id', '=', Auth::id())->delete();
       
      
    }

    public function edit_order($id){
        $order = Order::where('id', $id)->first();
        $prosthes_order = ProsthesOrder::where('order_id',$order->id)->get();
       
        $prostheses = [];
        foreach ($prosthes_order as $prosthes) {
            $prostheses[] = Prosthes::where('id',$prosthes->prosthes_id)->get();
        }
        
        return view('Admin.order_edit',[
            'order' => $order,
            'prosthes_order' => $prosthes_order,
            'prostheses' => $prostheses,
        ]);
    }

    public function upd_prices_order($id, Request $request){
        $order = Order::where('id', $id)->first();
        $prices = $request->input('prices');
        $temp = [];
        $sum = 0;
        

        foreach ($prices as $key => $price) {
            
            $keyParts = explode('_', $key);
            $productId = $keyParts[0];
            $side = $keyParts[1];
            
            $prot_order = ProsthesOrder::where('prosthes_id',  $productId)
                ->where('order_id', $id)
                ->where('side',$side)
                ->whereNotNull('price')
                ->first();
            if($prot_order){
                $temp[] = $prot_order->price;
                $prot_order->price = $price; 
                $prot_order->save();
            }
            $sum += $price;
        }
       
        $order->order_sum = $sum;
        $order->save();
        
        return redirect()->back();
    }

    public function success_order($id){
        // $order = Order::where('id', $id)->first();
        // $order->update([
        //     'ispayed' => 1,
        //     'isactive' =>0,
        // ]);
        // $order->fresh();
        
        DB::statement('CALL success_current_order( ? )', [$id]);
        return redirect()->back();
    }

    public function cancel_order($id){
        // $order = Order::where('id', $id)->first();

        // $order->update([
        //     'isactive' =>0,
        // ]);
        // $order->fresh();
        DB::statement('CALL cancel_current_order( ? )', [$id]);
        return redirect()->back();
    }

  
}
