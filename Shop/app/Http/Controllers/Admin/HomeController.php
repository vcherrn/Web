<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SpecificationFootController;
use App\Http\Controllers\SpecificationForearmController;
use App\Http\Controllers\SpecificationHipController;
use App\Http\Controllers\SpecificationKneeController;
use App\Http\Controllers\SpecificationShoulderController;
use App\Http\Controllers\SpecificationWristController;
use App\Models\ActiveRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Prosthes;
use App\Models\Creator;
use App\Models\ProsthesOrder;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SpecificationFoot;
use App\Models\SpecificationForearm;
use App\Models\SpecificationHip;
use App\Models\SpecificationKnee;
use App\Models\SpecificationShoulder;
use App\Models\SpecificationWrist;
use App\Models\User;
use App\Models\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Maatwebsite\Excel;

class HomeController extends Controller
{
    public function getusersChartData(){
        $users = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
        ->whereBetween('created_at', [Carbon::now()->subMonths(11)->startOfMonth(), Carbon::now()->endOfMonth()])
        ->groupBy('month')
        ->orderBy('month')
        ->get();
    
        $labels = [];
        $data = [];
        
        $startDate = Carbon::now()->subMonths(11)->startOfMonth();
        $currentDate = Carbon::now();
        
        while ($startDate <= $currentDate) {
            $monthLabel = $startDate->format('F Y');
            $count = 0;
        
            foreach ($users as $user) {
                if ($startDate->format('Y-m') === $user->month) {
                    $count = $user->count;
                    break;
                }
            }
        
            array_push($labels, $monthLabel);
            array_push($data, $count);
        
            $startDate->addMonth();
        }
        $chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Пользователи',
                    'data' => $data,
                    'backgroundColor' => 'rgba(0, 123, 255, 0.5)',
                    'borderColor' => 'rgba(0, 123, 255, 1)',
                    'borderWidth' => 1
                ]
            ]
        ];
        return $chartData;
    }

    public function getTypesCountChartData(){

        $categories = DB::table('prosthes')
            ->join('categories', 'prosthes.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', DB::raw('COUNT(*) as count'))
            ->groupBy('categories.name')
            ->get();

        $chartCount = [];
        $chartLabels = [];

        foreach ($categories as $category) {
            array_push($chartLabels, $category->category_name );
            array_push($chartCount, $category->count );
            
        }
       
        $chartData = [
            'labels' => $chartLabels,
            'datasets' => [
                [
                    'data' => $chartCount,
                    'backgroundColor' => ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                ]
            ]
        ];
        return $chartData;
    }

    public function getSalesChartData(){
        $orders = Order::selectRaw('DATE_FORMAT(updated_at, "%Y-%m") as month, COUNT(*) as count')
        ->whereBetween('updated_at', [Carbon::now()->subMonths(11)->startOfMonth(), Carbon::now()->endOfMonth()])
        ->where('isactive', 0)
        ->where('ispayed', 1)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $summary = Order::selectRaw('SUM(order_sum) as total_sum')
        ->where('isactive', 0)
        ->where('ispayed', 1)
        ->whereBetween('updated_at', [Carbon::now()->subMonths(11)->startOfMonth(), Carbon::now()->endOfMonth()])
        ->get();
    
        $labels = [];
        $data = [];
        
        $startDate = Carbon::now()->subMonths(11)->startOfMonth();
        $currentDate = Carbon::now();
        
        while ($startDate <= $currentDate) {
            $monthLabel = $startDate->format('F Y');
            $count = 0;
        
            foreach ($orders as $order) {
                if ($startDate->format('Y-m') === $order->month) {
                    $count = $order->count;
                    break;
                }
            }
        
            array_push($labels, $monthLabel);
            array_push($data, $count);
        
            $startDate->addMonth();
        }
        $chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Кол-во заказов',
                    'data' => $data,
                    'backgroundColor' => 'rgba(0, 123, 255, 0.5)',
                    'borderColor' => 'rgba(0, 123, 255, 1)',
                    'borderWidth' => 1
                ]
            ],
            'summary' => $summary
        ];
        return $chartData;
    }

    public function getPopularProductsData(){
        

        $popularProducts = DB::table('prosthes_orders')
        ->select('prosthes_id', DB::raw('COUNT(*) as total'))
        ->groupBy('prosthes_id')
        ->orderBy('total', 'desc')
        ->limit(5)
        ->get();

        $data = [];
        
        foreach ($popularProducts as $product) {
            $productData = Prosthes::find($product->prosthes_id);
            $productData->total = $product->total;
            array_push($data, $productData);
        }


        return $data;
    }

    public function getInfoData(){
        
        $wishlistCountItems = DB::table('wishlists')
        ->select(DB::raw('COUNT(*) as total'))
        ->get();

        $data = [];

        $data['wishlistCountItems'] = $wishlistCountItems;

        $cartCountItems = DB::table('carts')
        ->select(DB::raw('COUNT(*) as total'))
        ->get();
        
        $data['cartCountItems'] = $cartCountItems;

        $requestCountItems = DB::table('active_requests')
        ->select(DB::raw('COUNT(*) as total'))
        ->get();
        
        $data['requestCountItems'] = $requestCountItems;
        
        $returnedOrders = DB::table('orders')
        ->select(DB::raw('COUNT(*) as total'))
        ->where('isactive',0)
        ->where('ispayed',0)
        ->get();

        $data['returnedOrders'] = $returnedOrders;


        return $data;
    }
    public function index()
    {   
        $user = User::find(Auth::id());
        if($user->user_role == 1){
            $prosthes_count = Prosthes::all()->count();
            $users_count = User::all()->count();
            $requests_count = ActiveRequest::where('request_status', 1)->count();
          
            $usersChartData = $this->getusersChartData();
            $salesChartData = $this->getSalesChartData();
            $popularProductsData = $this->getPopularProductsData();
            $infoData = $this->getInfoData();
            $typesCountData = $this->getTypesCountChartData();
            return view('Admin.home', [
                'prosthes_count' => $prosthes_count,
                'users_count' => $users_count,
                'requests_count' => $requests_count,
                'usersChartData' => $usersChartData,
                'salesChartData' => $salesChartData,
                'popularProductsData' => $popularProductsData,
                'infoData' => $infoData,
                'typesCountData'=>$typesCountData
            ]);
        }
        

            
       
    }
    public function show_users(Request $request){
        $perPage = $request->input('perPage', 5);
        $userFilter = $request->input('userFilter');
        $statusFilter = $request->input('statusFilter');
        $search_string = $request->input('search_string');

        $users = User::query();

        if ($userFilter !== null) {
            $users->where('user_role', $userFilter);
        }

        if($search_string !== null){
            $users->where('id','like','%'. $search_string.'%');
        }
        $users = $users->paginate($perPage);
            
            if ($request->ajax()) {
                
                return view('Admin.users', compact('users'))->render();
            }

        return view('Admin.users', [
            'users' => $users,
            'userFilter' => $userFilter,
        
        ])->render();
    }
    public function edit_role($id, Request $request){
        $user = User::find($id);
        $userRole =  $request->input('user_role');

        if($userRole == 2) {
              if( $user->user_role == 2){
                    $user->user_role = 0;
                    
              } 
              else{ 
                $user->user_role = 2; 
                Review::where('user_id', $user->id)->delete(); 
            }
        }
        else{ 
            $user->user_role = $user->user_role == 1 ? false : true;
        }

        $user->save();
        return redirect()->back()->with('success', 'Роль пользователя успешно обновлена.');
    }
   
    
    public function et_pagination(Request $request){
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

        $orders = Order::latest()->paginate($perPage);
       
    
        return view('Admin.orders', compact('orders'))->render();
       
    }
    

    public function store(Request $request)
    {   
      
        
        $specification_id = $request->input('cat_id');
        $specification = [];
        switch ($specification_id) {
            case 1:
                $specification_shoulder = new SpecificationShoulderController();
                $specification = $specification_shoulder->store($request);
                break;
            case 2:
                $specification_forearm = new SpecificationForearmController();
                $specification = $specification_forearm->store($request);
                break;
            case 3:
                $specification_wrist = new SpecificationWristController();
                $specification = $specification_wrist->store($request);
                break;
            case 4:
                $specification_hip = new SpecificationHipController();
                $specification = $specification_hip->store($request);
                break;
            case 5:
                $specification_knee = new SpecificationKneeController();
                $specification = $specification_knee->store($request);
                break;
            case 6:
                $specification_foot = new SpecificationFootController();
                $specification = $specification_foot->store($request);
                break;
            default:
                break;
        }

        $prosthes = new Prosthes;

        
        $creatorName = $request->input('creator');
    
        $creator = Creator::where('name', $creatorName)->first();
        if ($creator) {
          
            $prosthes->creator_id = $creator->id;
        } else {
            $newCreator = new Creator();
            $newCreator->name = $creatorName;
            $newCreator->save();
            
            $prosthes->creator_id = $newCreator->id;
        }
        $prosthes->specifiable_id = $specification[0];
        $prosthes->specifiable_type = $specification[1];
        $prosthes->category_id = $request->input('cat_id');
        $prosthes->status = 1;
        $prosthes->article = $request->input('article');
        $prosthes->name =  $request->input('name');
        $prosthes->description =$request->input('description');
        $prosthes->price = $request->input('price');
        $prosthes->year_of_creating = $request->input('date_cr');

        $prosthes->save();

        $prosthes = Prosthes::findOrFail($prosthes->id);

        $currentDirectory = 'photos/prostheses/' . $request->input('name');
        Storage::disk('public')->makeDirectory($currentDirectory);

        $photos = $request->photos;
        $jsonPhotos = [];
        $base64Photos = [];
        $old_photos = [];

        foreach ($photos as $photo) {
            if (strpos($photo, 'data:image') !== false) {
                // Если данные представлены в формате base64
                $base64Photos[] = $photo;
            } else {
                // Если данные представлены в виде относительного пути
                $photoContents = file_get_contents(storage_path('app/public/' . $photo));
                $base64Photo = base64_encode($photoContents);
                $old_photos[] = $base64Photo;
            }
        }
       
         $existingPhotos = json_decode($prosthes->photos, true);
         $prosthesisDirectory = 'photos/prostheses/' . $prosthes->name;
         $existingFiles = File::files(storage_path('app/public/' . $prosthesisDirectory));

        foreach ($existingFiles as $existingFile) {
            $filename = $existingFile->getFilename();
            if (!in_array($filename, $existingPhotos)) {
                Storage::disk('public')->delete($prosthesisDirectory . '/' . $filename);
            }
        }
        
        if($base64Photos){
            foreach ($base64Photos as $photo) {
                    list(, $encodedImage) = explode(';', $photo);
                    list(, $encodedImage) = explode(',', $encodedImage);
                    $decodedImage = base64_decode($encodedImage);
                    $path = $currentDirectory . '/' . uniqid() . '.jpg';
                    Storage::disk('public')->put($path, $decodedImage);
                    $jsonPhotos[] = $path;
                }
        }
        if ($old_photos){
            foreach ($old_photos as $photo) {
                $encodedImage = $photo;
               
                $decodedImage = base64_decode($encodedImage);
                $path = $currentDirectory . '/' . uniqid() . '.jpg';
                Storage::disk('public')->put($path, $decodedImage);
                $jsonPhotos[] = $path;
            }
        }
    
        $prosthes->update([
            'photos' =>json_encode($jsonPhotos)
        ]);
        $prosthes->fresh();
        $log = new Log;
        $log->event = 'Пользователь ' . Auth::id() . ' добавил новый протез ' . $prosthes->id;
        $log->created_at = now();
        $log->save();
        return redirect()->route('products.show');
        
         
    }



}
