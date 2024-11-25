<?php

use App\Http\Controllers\ActiveRequestController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProsthesController;
use App\Models\Prosthes;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CharacteristicController;
use App\Http\Controllers\UserCharacteriscticController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\Guest_RequestController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\RequestTypeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SpecificationFootController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\WishlistController;
use App\Models\SpecificationFoot;
use Database\Factories\ReviewFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/shop', function () {
    return Inertia::render('StartPage');
})->name('shop');

Route::get('/about-us', function () {
    return Inertia::render('AboutUs');
})->name('about_us');


Route::get('/chat', function () {
    return Inertia::render('ChatPage');
})->name('chat');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['prefix' => 'products'], function(){

    Route::get('/', [ProsthesController::class,'index'])->name('products.index');
    Route::get('/sort-by-ascending', [ProsthesController::class,'sortByAscending']);
    Route::get('/sort-by-descending', [ProsthesController::class,'sortByDescending']);
    Route::get('/{id}', function($id) {
        $product = Prosthes::findOrFail($id);
        return  Inertia::render('Product', ['product' => $product]);
    });
    Route::get('/prosthes-cat/{id}', [ProsthesController::class, 'showFilterCat']);
    Route::get('/prosthes-typ/{id}', [ProsthesController::class, 'showFilterTyp']);
    Route::post('/add-to-cart',[CartController::class,'store']);
    Route::post('/add-to-wishlist',[WishlistController::class,'store']);
    Route::get('/specification/{type}/id/{id}', [ProsthesController::class, 'show_specification']);
    
});
Route::get('load-specifications', [ProsthesController::class, 'load_specifications']);

Route::group(['prefix' => 'reviews'], function(){
    Route::get('/{id}',[ReviewController::class,'index']);
    Route::post('/send',[ReviewController::class,'store']);
    Route::delete('/delete/{id}', [ReviewController::class, 'deleteReview']);

});
Route::get('/has-purchased',[ReviewController::class,'hasPurchased']);

Route::group(['prefix'=>'request'], function(){
    Route::post('/store', [ActiveRequestController::class, 'store'])->name('request.store');
    Route::post('/for-guests/store', [Guest_RequestController::class, 'store'])->name('guestrequest.store');
});

Route::group(['prefix'=>'characteristic'], function(){
    Route::get('/', [UserCharacteriscticController::class, 'index'])->name('characteristic.index');
    Route::post('/store', [UserCharacteriscticController::class, 'store'])->name('characteristic.store');
});

Route::get('/get-all-requests-types', [RequestTypeController::class, 'index'])->name('types.index');

Route::get('/get-categories', [CategoryController::class, 'showCategories']);
Route::get('/get-types', [TypeController::class, 'index']);
Route::get('/get-characteristics', [CharacteristicController::class, 'getCharacteristics']);

Route::group(['prefix' => 'cart'], function(){

    Route::get('/', function(){
        return Inertia::render('Cart');
    })->middleware(['auth','verified'])->name('cart');
    Route::get('/products', function(){ 
        return DB::table('prosthes')
            ->join('carts', 'prosthes.id', '=', 'carts.prosthes_id')
            ->where('carts.user_id', '=', Auth::id())
            ->get();
    });
    Route::delete('/delete/{id}', [CartController::class,'destroy']);
    Route::put('/update', [CartController::class,'cartUpdate']);

});


Route::group(['prefix' => 'wishlist'], function(){

    Route::get('/', function(){
        return Inertia::render('WishList');
    })->middleware(['auth','verified'])->name('wishlist');
    Route::get('/products', function(){ 
        return DB::table('prosthes')
            ->join('wishlists', 'prosthes.id', '=', 'wishlists.prosthes_id')
            ->where('wishlists.user_id', '=', Auth::id())
            ->get();
    });
    Route::post('/add-to-cart',[WishlistController::class,'addToCart']);
    Route::delete('/delete/{id}',[WishlistController::class,'delete']);

});

Route::get('/history', function(){
    return Inertia::render('OrdersHistory');
})->middleware(['auth','verified'])->name('OrdersHistory');

Route::get('/constructor', function(){
    return Inertia::render('Constructor');
})->name('constructor');

Route::post('constructor/add-to-cart',[CartController::class,'constructor_store']);

Route::get('/load-orders', function(){ 
    return DB::table('prosthes')
     ->join('prosthes_orders', 'prosthes.id', '=', 'prosthes_orders.prosthes_id')
     ->join('orders', 'prosthes_orders.order_id', '=', 'orders.id')
     ->select('prosthes.name as prosthes_name','orders.updated_at as order_update',
     'orders.created_at as order_create', 'prosthes_orders.*', 'orders.*', 'prosthes.*')
     ->where('orders.user_id', '=', Auth::id())
     ->orderByDesc('orders.id')
    ->get();
});


Route::get('/order', function(){
    return Inertia::render('Order');
})->middleware(['auth','verified'])->name('order');



Route::post('/order-confirm',[OrderController::class,'store']);



//Admin
Route::group(['prefix' => 'administration'], function(){
    Route::get('/', [HomeController::class,'index'])->name('admin.home');
    Route::get('/export/products-sales', [ExportController::class,'exportProducts'])->name('export.products');
 
    Route::get('/product/create', [ProsthesController::class,'create'])->name('product.create');
    Route::get('/product/edit/{prosthes}', [ProsthesController::class,'edit'])->name('product.edit');
    Route::post('/product/update/{prosthes}', [ProsthesController::class,'update'])->name('product.update');
    Route::get('/product/delete/{prosthes}', [ProsthesController::class,'delete'])->name('product.delete');
    Route::get('/all-products', [ProsthesController::class,'show_all'])->name('products.show');

    Route::post('/create-product', [HomeController::class, 'store'])->name('product.store');
   
    Route::get('/orders', [OrderController::class,'show_orders'])->name('orders.show');
    
    Route::get('/order/edit/{id}', [OrderController::class,'edit_order'])->name('order.edit');
    Route::put('/order/success/{id}', [OrderController::class,'success_order'])->name('order.success');
    Route::put('/order/cancel/{id}', [OrderController::class,'cancel_order'])->name('order.cancel');
    Route::put('/order/updatePrices/{id}', [OrderController::class,'upd_prices_order'])->name('order.updatePrices');

    Route::get('/users', [HomeController::class,'show_users'])->name('users.show');
    Route::put('/users/edit-role/{id}', [HomeController::class, 'edit_role'])->name('users.edit');

    Route::get('/users-requests', [ActiveRequestController::class, 'index'])->name('activerequests.index');
    Route::get('/users-requests/delete/{id}', [ActiveRequestController::class, 'delete'])->name('activerequests.delete');
    Route::get('/users-requests/edit/{id}', [ActiveRequestController::class, 'show_edit'])->name('activerequests.edit');

    Route::get('/guests-requests', [Guest_RequestController::class, 'index'])->name('guestrequests.index');
    Route::get('/guests-requests/delete/{id}', [Guest_RequestController::class, 'delete'])->name('guestrequests.delete');
    Route::get('/guests-requests/edit/{id}', [Guest_RequestController::class, 'show_edit'])->name('guestrequests.edit');

    Route::get('/categories', [CategoryController::class,'category_list_show'])->name('categorylist.show');
    Route::get('/categories/edit/{id}', [CategoryController::class,'category_edit'])->name('categorylist.edit');
    Route::put('/categories/update/{id}', [CategoryController::class,'category_update'])->name('category.update');
    Route::get('/categories/create', [CategoryController::class,'category_create'])->name('category.create');
    Route::post('/categories/store', [CategoryController::class,'category_store'])->name('category.store');
    Route::delete('/categories/delete/{id}', [CategoryController::class,'delete'])->name('category.delete');

    Route::get('/creators', [CreatorController::class,'creators_show'])->name('creators.show');
    Route::get('/creators/edit/{id}', [CreatorController::class,'creator_edit_show'])->name('creator.edit');
    Route::put('/creators/update/{id}', [CreatorController::class,'creator_update'])->name('creator.update');
    Route::get('/creators/create', [CreatorController::class,'creator_create'])->name('creator.create');
    Route::post('/creators/store', [CreatorController::class,'creator_store'])->name('creator.store');
    Route::delete('/creators/delete/{id}', [CreatorController::class,'delete'])->name('creator.delete');
});

Route::get('/get-creator-info/{id}', [CreatorController::class,'show_current_creator']);


Route::get('get-category-content/{id}', [CategoryController::class,'index'])->name('category.show');
Route::get('get-category-content/upd/{id}/{prosthes}', [CategoryController::class,'show_category_for_update'])->name('category.show_upd');

