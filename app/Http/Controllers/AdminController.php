<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Message;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    //
    public function index(){
        $id = Auth::check()?Auth::user()->id:0;
        $barang = Product::all()->count();
        $message = $this->getMessageCount();
        $inbox = Message::select('*')
            ->distinct()
            ->count('user_id');
        $sold = OrderDetail::select('*')
            ->count();
        $order = Order::select('*')
            ->where('order_status', 'Proses')
            ->count();
        $finish_order = Order::select('*')
            ->where('order_status', 'Selesai')
            ->count();
        $cancel_order = Order::select('*')
            ->where('order_status', 'Cancel')
            ->orWhere('order_status', 'Expired')
            ->count();
        $shipping_order = Order::select('*')
            ->where('shipping_status', 'Dikirim')
            ->count();
        $userCount = User::all()
            //->where('role', 'Member')
            ->count();

        $potential = User::select('*')
            ->whereHas('order', function($query){
                $query->where('order_status', 'Proses');
            })
            ->count();
        
        $lastOrder = Order::all()
            ->where('status', 'Diproses');

        $User = User::select('*')
            ->whereHas('order', function($query){
                $query->where('status_payment', 'Lunas')
                    ->where('order_status', 'Proses');
            });
        $listOrder = $this->getProsesOrder();
        return view(
            'admin.index', 
            compact('barang', 'message', 'inbox', 'sold', 'order', 'finish_order', 'cancel_order', 'shipping_order', 'userCount', 'potential', 'lastOrder', 'User', 'listOrder'));
    }

    protected function getProsesOrder(){
        $order = Order::select('*')
            ->where('order_status', 'Proses')
            ->where('status_payment', 'Belum Lunas')
            ->get();
        return $order;
    }

    public function username(Request $request){
        $username = $request->username;
        $user = User::where('username','like','%'.$username.'%')->get();
        return response()->json($user);

    }


    public function settings(){

    }

    protected function getInboxCount()
    {
        $inbox = Message::select('*')
            ->distinct()
            ->count('user_id');
        return $inbox;
    }

    public function getMessageCount()
    {
        $message = Message::select('*')
        ->where('read', 0)
        ->count();
        return $message;
    }

}
