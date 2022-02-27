<?php

namespace App\Http\Controllers;


use App\Models\Message;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //


    protected function getInboxCount($id)
    {
        $inbox = Message::select('*')
            ->distinct()
            ->count('user_id');
        return $inbox;
    }


    public function getMessageCount($id)
    {
        $message = Message::select('*')
        ->where('read', 0)
        ->count();
        return $message;
    }

    protected function getCartCount($id)
    {
        $cart_count = Cache::remember('cart_count_' . $id, now()->addMinutes(30), function () use ($id) {
            return Cart::where('user_id', $id)->count();
        });
        return $cart_count;
    }


    public function index(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $product = Product::latest();
        if(request('search')){
            $product = $product
            ->where('name', 'like', '%'.request('search').'%')
            ->where('status', 'Available')
            ->orWhere('deskripsi', 'like', '%'.request('search').'%')
            ->orWhereHas('category', function($query){
                $query->where('name', 'like', '%'.request('search').'%');
            });
        }
        $product = $product->paginate(20);
        return view('Admin.Product.index', \compact( 'message', 'inbox', 'product'));
    }

    public function create(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $category = Category::all();
        return view('Admin.Product.create', compact('category', 'message', 'inbox'));
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
        $validatedData['image'] = $request->file('image')->store('products');

        Product::create($validatedData);
        return redirect()->route('admin.product.index');
    }

    public function edit(Request $request){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $category = Category::all();
        $product = Product::find($request->id);
        return view('Admin.Product.edit', compact('product', 'category', 'message', 'inbox'));
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
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
