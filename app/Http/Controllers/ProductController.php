<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Message;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    protected function getCartCount($id)
    {
        $cart_count = Cache::remember('cart_count_' . $id, now()->addMinutes(30), function () use ($id) {
            return Cart::where('user_id', $id)->count();
        });
        return $cart_count;
    }


    public function index(){
        $report = $this->report;
        $message = $this->message;
        $inbox = $this->inbox;
        $product = Product::latest();
        if(request('search')){
            $product = $product
            ->where('name', 'like', '%'.request('search').'%')
            ->orWhere('deskripsi', 'like', '%'.request('search').'%')
            ->orWhereHas('category', function($query){
                $query->where('name', 'like', '%'.request('search').'%');
            });
        }
        $product = $product->paginate(20);
        return view('Admin.Product.index', \compact('report', 'message', 'inbox', 'product'));
    }

    public function create(){
        $report = $this->report;
        $message = $this->message;
        $inbox = $this->inbox;
        $category = Category::all();
        return view('Admin.Product.create', compact('category', 'report', 'message', 'inbox'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'deskripsi' => 'required',
            'price' => 'required',
            'capital' => 'required',
            'stock' => 'required',
            'id_category' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
        $validatedData['image'] = $request->file('image')->store('products');

        Product::create($validatedData);
        return redirect()->route('admin.product.index');
    }

    public function edit($id){
        $report = $this->report;
        $message = $this->message;
        $inbox = $this->inbox;
        $category = Category::all();
        $product = Product::find($id);
        return view('Admin.Product.edit', compact('product', 'category', 'report', 'message', 'inbox'));
    }

    public function update(Request $request){
        $data = $request->validate([
            'name' => 'required|max:255',
            'deskripsi' => 'required',
            'price' => 'required',
            'capital' => 'required',
            'stock' => 'required',
            'id_category' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('image')){ 
            $oldImage = Product::find($request->id);
            Storage::delete($oldImage->image);
            $imageName = time().'.'.$request->image->extension();  
            $data['image'] = $request->file('image')->store('products');
        }

        Product::where('id', $request->id)
            ->update($data);
        return redirect()->route('admin.product.index');

    }

    public function destroy(Request $request){
        $product = Product::where('id', $request->id)->first();
        $image = $product->image;
        Storage::delete('products/'.$image);
        $product->delete();
        return redirect()->route('admin.product.index');
    }
}
