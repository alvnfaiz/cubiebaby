<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class MemberController extends Controller
{
    //
    public function index(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $cart_count = $this->getCartCount($id);
        $user = User::where('id', $id)->first();
        return view('Member.profile', compact('user', 'message', 'cart_count'));
    }

    public function edit(Request $request){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $cart_count = $this->getCartCount($id);

        $user = User::where('id', $id)->first();
        return view('Member.edit', compact('user', 'message', 'cart_count'));
    }

    public function update(Request $request){
        $id = Auth::user()->id;

        $user = User::where('id', $id)->first();
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,'.$request->username,
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->email,
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
        ]);

        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->updated_at = now();
        $user->save();

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
            ->count();
        return $this->message;
    }
}
