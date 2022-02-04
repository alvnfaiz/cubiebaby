<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Report;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    //
    protected $message;
    protected $report;
    protected $inbox;

    public function index(){
        $products = Product::latest();
        $id = isset(auth()->user()->id)?auth()->user()->id:0;
        $report = $this->getReportCount($id);
        $message = $this->getMessageCount($id);
        $cart_count = $this->getCartCount($id);
        if(request('search')){
            $products = $products
            ->where('name', 'like', '%'.request('search').'%')
            ->orWhere('deskripsi', 'like', '%'.request('search').'%')
            ->orWhereHas('category', function($query){
                $query->where('name', 'like', '%'.request('search').'%');
            });
        }
        $barangs = $products->paginate(12);
        return view('home', compact('barangs', 'message', 'report', 'cart_count'));
    }

    public function showBarang(Request $request){
        $id = isset(auth()->user()->id)?auth()->user()->id:0;
        $message = $this->getMessageCount($id);
        $report = $this->getReportCount($id);
        $cart_count = $this->getCartCount($id);
        $barang = Product::where('id', $request->id)->first();
        return view('product', compact('barang', 'report', 'message', 'cart_count'));

    }

    public function category(Request $request){
        $id = isset(auth()->user()->id)?auth()->user()->id:0;
        $barangs = Product::where('id_category', $request->id)->get();
        $message = $this->getMessageCount($id);
        $report = $this->getReportCount($id);
        $cart_count = $this->getCartCount($id);
        return view('category', compact('barangs', 'message', 'report', 'cart_count'));
    }

    public function cart(){
        $id = isset(auth()->user()->id)?auth()->user()->id:0;
        $message = $this->getMessageCount($id);
        $report = $this->getReportCount($id);
        $cart_count = $this->getCartCount($id);
        $total_price = $this->getTotalPrice();
        $cart = Cart::where('user_id', $id)->get();
        return view('cart', compact('message', 'report', 'cart_count', 'cart','total_price'));
    }

    public function addCart(Request $request){
        $id = isset(auth()->user()->id)?auth()->user()->id:0;
        $message = $this->getMessageCount($id);
        $report = $this->getReportCount($id);
        $cart_count = $this->getCartCount($id);
        //if id =0 save cart in cache
        if($id == 0){
            $cart = \Cache::get('cart');
            if(!$cart){
                $cart = [];
            }
            //if cart exist in cache, add product by 1
            if(array_key_exists($request->id, $cart)){
                $cart[$request->id] += 1;
            }else{
                $cart[$request->id] = 1;
            }
            Cache::forever('cart', $cart);
            return redirect()->route('login');
        }else{
            $cart = Cart::where('user_id', $id)
                ->where('product_id', $request->id)
                ->first();
            if($cart){
                $cart->total_product += 1;
                $cart->save();
            }else{
                Cart::create([
                    'user_id' => $id,
                    'product_id' => $request->id,
                    'total_product' => 1,
                ]);
            }
        }
        return redirect()->route('cart');
    }


    protected function getCartCount($id = 0){
        if($id == 0){
            $cart = Cache::get('cart');
            if(!$cart){
                return 0;
            }
            return count($cart);
        }else{
            $cart = Cart::where('user_id', $id)->get();
            if(!$cart){
                return 0;
            }
            return count($cart);
        }
    }

    protected function getReportCount($id = 0){
        $this->report = Report::whereHas('reportReply', function($query){
            $query->where('read', 0);
        })->where('user_id', $id)
        ->count();
        return $this->report;
    }

    protected function getMessageCount($id = 0){
        $this->message = Message::select('*')
            ->where('user_id', $id)
            ->where('read', 0)
            ->count();
        return $this->message;
    }

    public function apiAddCart(Request $request){
        $id = isset(auth()->user()->id)?auth()->user()->id:0;
        //if id =0 save cart in cache
        if($id == 0){
            $cart = Cache::get('cart');
            if(!$cart){
                $cart = [];
            }
            //if cart exist in cache, add product by 1
            if(array_key_exists($request->product_id, $cart)){
                $cart[$request->product_id] += $request->qty;
            }else{
                $cart[$request->product_id] = 1;
            }
            Cache::forever('cart', $cart);
            $cart_count=$request->qty;
        }else{
            $cart = Cart::where('user_id', $id)
                ->where('product_id', $request->product_id)
                ->first();
            if($cart){
                $cart->total_product += 1;
                $cart->save();
            }else{
                Cart::create([
                    'user_id' => $id,
                    'product_id' => $request->product_id,
                    'total_product' => 1,
                ]);
            }
        }
        //return json
        $price = Product::where('id', $request->product_id)->first()->price;
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart',
            'total_product' => 1,
            'price'=> $price->price,
            'total_price' => $this->getTotalPrice(),
        ]);
    }

    //apiUpdateCart
    public function apiUpdateCart(Request $request){
        $id = isset(auth()->user()->id)?auth()->user()->id:0;
        $product_id = $request->product_id;
        $qty = $request->qty;
        if($id == 0){
            $cart = Cache::get('cart');
            if(!$cart){
                $cart = [];
            }
            if(array_key_exists($request->product_id, $cart)){
                $cart[$request->product_id] =$request->qty;
                
            }else{
                $cart[$request->product_id] = 1;
                
            }
            Cache::forever('cart', $cart);
        }else{
            $cart = Cart::where('user_id', $id)
                ->where('product_id', $request->product_id)
                ->first();
            if($cart){
                $cart->total_product = $request->qty;
                $cart->save();
            }else{
                Cart::create([
                    'user_id' => $id,
                    'product_id' => $request->product_id,
                    'total_product' => $request->qty,
                ]);
            }
            
        }
        $price = Product::where('id', $request->product_id)->first();
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart',
            'id_product' => $request->product_id,
            'total_product' => $request->qty,
            'price'=> $price->price,
            'total_price' => $this->getTotalPrice(),
        ]);
    }

    //apiDeleteCart
    public function apiDestroyCart(Request $request){
        $id = isset(auth()->user()->id)?auth()->user()->id:0;
        //if id =0 save cart in cache
        if($id == 0){
            $cart = Cache::get('cart');
            if(!$cart){
                $cart = [];
            }
            //if cart exist in cache, add product by 1
            if(array_key_exists($request->product_id, $cart)){
                unset($cart[$request->product_id]);
            }
            Cache::forever('cart', $cart);
        }else{
            $cart = Cart::where('user_id', $id)
                ->where('product_id', $request->product_id)
                ->first();
            if($cart){
                $cart->delete();
            }
        }
        //return json
        return response()->json([
            'success' => true,
            'message' => 'Cart deleted',
            'cart_count' => $this->getCartCount($id),
        ]);
    }

    public function apiCart(){
        $id = isset(auth()->user()->id)?auth()->user()->id:0;
        //if user is not logged in, get cache cart
        if(!auth()->check()){
            $cart = Cache::get('cart');
        }else{
            $cart = Cart::where('user_id', auth()->user()->id)->get();
        }
        //return json
        return response()->json([
            'success' => true,
            'message' => 'Cart',
            'cart_count' => $this->getCartCount($id),
            'cart' => $cart,
        ]);
    }

    public function getTotalPrice(){
        $id = auth()->user()->id;
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        $total = 0;
        foreach($cart as $item){
            $price = Product::where('id', $item->product_id)->first();
            $total += $item->total_product * $price->price;
        }
        return $total;
    }
}
