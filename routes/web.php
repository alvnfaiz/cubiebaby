<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\BotChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserMessageController;



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




//Login Register
Route::get('/login', [LoginController::class, 'loginForm'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticated']);
Route::get('/register', [LoginController::class, 'registerForm'])->middleware('guest')->name('register');
Route::post('/register', [LoginController::class, 'register']);
Route::get('/forget-password', [LoginController::class, 'forgetPasswordForm'])->middleware('guest')->name('forget-password');
Route::post('/forget-password', [LoginController::class, 'forgetPassword'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', [LoginController::class, 'resetPassword'])->middleware('guest')->name('password.update');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');




//Pegawai Area
Route::get('/admin', [AdminController::class, 'index'])->middleware('pegawai')->name('dashboard');

Route::middleware('pegawai')->prefix('/admin')->name('admin.')->group(function(){
    Route::prefix('/product')->name('product.')->group(function(){
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/create', [ProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{id}/edit', [ProductController::class, 'update'])->name('update');
        Route::post('/{id}/delete', [ProductController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/category')->name('category.')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/create', [CategoryController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{id}/edit', [CategoryController::class, 'update'])->name('update');
        Route::post('/{id}/delete', [CategoryController::class, 'delete'])->name('delete');
    });

    Route::prefix('/order')->name('order.')->group(function(){
        Route::get('/', [OrderController::class, 'indexAdmin'])->name('index');
        Route::get('/proses', [OrderController::class, 'proses'])->name('proses');
        Route::get('/cancel', [OrderController::class, 'cancel'])->name('cancel');
        Route::get('/selesai', [OrderController::class, 'selesai'])->name('selesai');
        Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [OrderController::class, 'update'])->name('update');
    });

    Route::prefix('/message')->name('message.')->group(function(){
        Route::get('/', [MessageController::class, 'index'])->name('index');
        Route::post('/api', [MessageController::class, 'apiGetMessage'])->name('get');  
        Route::post('/send', [MessageController::class, 'apiSendMessage'])->name('send');        
        Route::post('/api/new', [MessageController::class, 'apiGetNewMessage'])->name('list');
        // Route::post(''
    });

});

//Admin Area
Route::middleware('admin')->prefix('')->name('admin.')->group(function(){
    // Route::prefix('/pegawai')->name('pegawai.')->group(function(){
    //     Route::get('/', [PegawaiController::class, 'index'])->name('index');
    //     Route::get('/create', [PegawaiController::class, 'create'])->name('create');
    //     Route::post('/create', [PegawaiController::class, 'store'])->name('store');
    //     Route::get('/{id}/edit', [PegawaiController::class, 'edit'])->name('edit');
    //     Route::put('/{id}/edit', [PegawaiController::class, 'update'])->name('update');
    //     Route::post('/{id}/delete', [PegawaiController::class, 'delete'])->name('delete');
    // });
    Route::post('/username', [AdminController::class, 'username'])->name('username');
    Route::post('/report/get', [ReportController::class, 'getReport'])->name('report.get');
    Route::prefix('/report')->name('report.')->group(function(){      
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/member', [ReportController::class, 'member'])->name('member');
        Route::get('/sale', [ReportController::class, 'sale'])->name('sale');
        Route::get('/pdf', [ReportController::class, 'createPDF'])->name('pdf');
        
    });

    // shipping
    Route::prefix('/shipping')->name('shipping.')->group(function(){
        Route::get('/', [ShippingController::class, 'index'])->name('index');
        Route::get('/create', [ShippingController::class, 'create'])->name('create');
        Route::post('/create', [ShippingController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ShippingController::class, 'edit'])->name('edit');
        Route::put('/{id}/edit', [ShippingController::class, 'update'])->name('update');
        Route::post('/{id}/delete', [ShippingController::class, 'delete'])->name('delete');
    });

    Route::prefix('/banner')->name('banner.')->group(function(){
        Route::get('/', [BannersController::class, 'index'])->name('index');
        Route::get('/create', [BannersController::class, 'create'])->name('create');
        Route::post('/create', [BannersController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BannersController::class, 'edit'])->name('edit');
        Route::put('/{id}/edit', [BannersController::class, 'update'])->name('update');
        Route::post('/{id}/delete', [BannersController::class, 'delete'])->name('delete');
    });

    Route::prefix('/botchat')->name('botchat.')->group(function(){
        Route::get('/', [BotChatController::class, 'index'])->name('index');
        Route::get('/create', [BotChatController::class, 'create'])->name('create');
        Route::post('/create', [BotChatController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BotChatController::class, 'edit'])->name('edit');
        Route::put('/{id}/edit', [BotChatController::class, 'update'])->name('update');
        Route::post('/{id}/delete', [BotChatController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/broadcast')->name('broadcast.')->group(function(){
        Route::get('/', [BroadcastController::class, 'index'])->name('index');
        Route::get('/create', [BroadcastController::class, 'create'])->name('create');
        Route::post('/create', [BroadcastController::class, 'store'])->name('store');
    });


});

//Member Area
Route::get('/profile', [MemberController::class, 'index'])->middleware('member')->name('member.profile');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/message', [UserMessageController::class, 'index'])->middleware('member')->name('message');
Route::post('/api/message', [UserMessageController::class, 'apiSend'])->middleware('member')->name('message.send');
Route::post('/api/message/list', [UserMessageController::class, 'apiGetNewMessage'])->middleware('member')->name('message.get');

//Order
Route::post('/order/add', [OrderController::class, 'store'])->middleware('member')->name('member.order.add');
Route::get('/order', [OrderController::class, 'index'])->middleware('member')->name('member.order.index');
Route::put('/order/{id}/update', [OrderController::class, 'insertMedia'])->middleware('member')->name('member.order.update');
Route::get('/order/{id}', [OrderController::class, 'detail'])->middleware('member')->name('member.order.detail');


Route::get('/product/{id}', [HomeController::class, 'showBarang'])->name('product.show');
Route::get('/product', [HomeController::class, 'product'])->name('product');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.show');
Route::get('/search', [HomeController::class, 'index'])->name('search');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');


//destroy cart
Route::post('/cart/{id}/delete', [HomeController::class, 'destroyCart'])->name('cart.destroy');
Route::post('/add', [HomeController::class, 'addCart'])->name('buy.add');

//api to add cart
Route::get('/api/cart', [HomeController::class, 'apiCart'])->name('api.cart');
Route::post('/api/cart/add', [HomeController::class, 'apiAddCart'])->name('api.cart.add');
Route::post('/api/cart/destroy', [HomeController::class, 'apiDestroyCart'])->name('api.cart.delete');
Route::post('/api/cart/update', [HomeController::class, 'apiUpdateCart'])->name('api.cart.update');
//api cart ship
Route::post('/api/cart/ship', [HomeController::class, 'apiCostUpdate'])->name('api.cart.ship');
