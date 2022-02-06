<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;

use App\Models\Message;
use App\Models\Product;
use App\Models\Category;
use App\Models\Shipping;
use App\Models\Destination;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //

    public function edit(Request $request){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getCartCount($id);
        $order = Order::where('id', $request->id)
        ->first();
        // dd($order->destination);
        $order_detail = OrderDetail::where('order_id', $request->id)->get();
        return view('Admin.order.edit', compact('order', 'message', 'inbox', 'order_detail'));
    }

    public function update(Request $request){
        Order::where('id', $request->id)
        ->update([
            'status_payment' => $request->payment_status,
            'order_status' => $request->order_status,
            'resi_number' => $request->resi_number,
            'shipping_status' => $request->shipping_status,
        ]);        
        return redirect()->route('admin.order.index');
    }


    public function proses(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getCartCount($id);
        $orders = Order::where('order_status', 'Proses')->paginate(20);
        return view('Admin.order.proses', compact( 'message', 'inbox', 'orders'));
    }

    public function indexAdmin(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getCartCount($id);
        $orders = Order::paginate(20);
        return view('Admin.order.proses', compact( 'message', 'inbox', 'orders'));
    }

    public function cancel(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getCartCount($id);
        $orders = Order::where('order_status', 'Cancel')->
        orWhere('order_status', 'Expired')->paginate(20);
        return view('Admin.order.proses', compact( 'message', 'inbox', 'orders'));
    }

    public function selesai(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getCartCount($id);
        $orders = Order::where('order_status', 'Selesai')->paginate(20);
        return view('Admin.order.proses', compact( 'message', 'inbox', 'orders'));
    }


    public function store(Request $request){
        $id = Auth::user()->id;
        $cart = Cart::where('user_id', $id)->get();
        $total_price = $this->getTotalPrice();
        $destination = Destination::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        $barang = Cart::where('user_id', $id)->get();
        $cost = Shipping::where('id', $request->shipping_id)->first();
        $order = Order::create([
            'user_id' => $id,
            'total_price' => $total_price + $cost->cost,
            'cart' => $cart,
            'total' => $cart->sum('total'),
            'status_payment' => 'Belum Lunas',
            'shipping_status' => 'Diproses',
            'resi_number' => '',
            'order_status' => 'Proses',
            'image' => '',
            'shipping_id' => $request->shipping_id,
            'destination_id' => $destination->id,
            //expiration = now + 3 days
            'expired_at' => now()->addDays(3),
            'created_at' => now(),
            'updated_at' => now(),
            

        ]);
        foreach($barang as $item){
            //save to order detail
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'total' => $item->total_product,
                'price' => $item->product->price,
            ]);
            //remove cart
            $item->delete();
        }

        return redirect()->route('member.order.detail', $order->id);
    }

    public function index(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $cart_count = $this->getCartCount($id);
        $orders = Order::where('user_id', $id)->get();
        return view('member.order.index', compact('orders', 'message', 'cart_count'));
    }

    public function detail(Request $request){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $cart_count = $this->getCartCount($id);
        $id = Auth::user()->id;
        $category = Category::all();
        $order = Order::where('id', $request->id)->first();
        $orderDetail = Order::where('id', $request->id)->first()->detail;
        return view('member.order.detail', compact('order', 'message', 'cart_count', 'orderDetail', 'category'));
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



    protected function getMessageCount($id = 0){
        $this->message = Message::select('*')
            ->where('user_id', $id)
            ->where('read', 0)
            ->where('admin', true)
            ->count();
        return $this->message;
    }
}
