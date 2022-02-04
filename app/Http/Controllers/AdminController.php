<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Report;
use App\Models\Message;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->barang = Product::all()->count();
        $this->id = isset(auth()->user()->id)?:0;
        $this->message = Message::select('*')
            ->where('read', 0)
            ->count();
        $this->report = Report::where('status', 'open')
            ->where('read', 0)
            ->count();
    }

    //
    public function index(){
        $barang = $this->barang;
        $id = $this->id;
        $message = $this->message;
        $report = $this->report;
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
        
        return view(
            'admin.index', 
            compact('barang', 'message', 'report', 'inbox', 'sold', 'order', 'finish_order', 'cancel_order', 'shipping_order', 'userCount', 'potential', 'lastOrder', 'User'));
    }


    public function settingsForm(){
        return view('admin.setting');
    }

    public function settings(){

    }

}
