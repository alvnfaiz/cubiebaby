<?php

namespace App\Http\Controllers;


use App\Models\Message;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    //
    public function index(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $shippings = Shipping::all();
        return view('Admin.shipping.index', compact('shippings', 'message', 'inbox'));
    }

    public function create(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        return view('Admin.shipping.create', compact( 'message', 'inbox'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'city' => 'required|string|max:255',
            'cost' => 'required|numeric',
        ]);

        Shipping::create([
            'city' => $request->city,
            'cost' => $request->cost,
        ]);
        return redirect()->route('admin.shipping.index');
    }

    public function edit(Request $request){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $shipping = Shipping::where('id', $request->id)->first();
        return view('Admin.shipping.edit', compact('shipping', 'message', 'inbox'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'city' => 'required|string|max:255',
            'cost' => 'required|numeric',
        ]);
        $shipping = Shipping::find($request->id);
        $shipping->city = $request->city;
        $shipping->cost = $request->cost;
        $shipping->save();
        return redirect()->route('admin.shipping.index');
    }

    public function destroy(Request $request){
        $shipping = Shipping::find($request->id);
        $shipping->delete();
        return redirect()->route('admin.shipping.index');
    }


    public function getMessageCount($id){
        $message = Message::where('user_id', $id)->where('read', 0)->count();
        return $message;
    }

    public function getInboxCount($id){
        $inbox = Message::select('*')
            ->distinct()
            ->count('user_id');
        return $inbox;
    }

    
}
