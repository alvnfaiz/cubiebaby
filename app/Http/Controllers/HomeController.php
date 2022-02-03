<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $barang = Product::all();
        $id = isset(auth()->user()->id)?auth()->user()->id:0;
        $message = Message::select('*')
            ->where('user_id', $id)
            ->where('read', 0)
            ->count();
        $report = Report::whereHas('reportReply', function($query){
            $query->where('read', 0);
        })
        ->where('user_id', $id)
        ->count();
        return view('home', compact('barang', 'message', 'report'));
    }

    public function showBarang(Request $request){
        $barang = Product::where('id', $request->id)->first();
        
        return view('product', compact('id'));

    }
}
