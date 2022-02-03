<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->message = Message::select('*')
            ->where('read', 0)
            ->count();
        $this->report = Report::where('status', 'open')
            ->where('read', 0)
            ->count();
        $this->inbox = Message::select('*')
            ->distinct()
            ->count('user_id');
    }

    public function index(){
        return view('Admin.Product.index');
    }

    public function create(){
        $category = Category::all();
        return view('product.create', compact('category'));
    }
}
