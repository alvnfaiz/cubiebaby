<?php

namespace App\Http\Controllers;

use App\Models\Cart;

use App\Models\User;
use App\Models\Order;
use App\Models\Message;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class MemberController extends Controller
{
    //
    public function memberList(){
        $users = User::where('role', 'Member')->get();
        $id = Auth::user()->id;
        $message = $this->getMessageCount();
        $inbox = $this->getInboxCount($id);
        return view('Admin.member', compact('message', 'inbox', 'users'));
    }

    public function destroy(Request $request){
        $user = User::where('role', 'Member')->where('id', $request->id)->first();
        if($user->order->where('order_status', '!=', 'Selesai')->count()>0){
            return redirect(route('admin.member.list'))->withErrors('undelete', 'member Memiliki Pesanan Aktif, tidak dapat dihapus');   
        }else{
            // $user->user_activity->delete();

            $order = Order::where('user_id', $user->id)->get();
            foreach($order as $ord){
                $orderdetail = OrderDetail::where('order_id', $order->id)->whereHas('order', function($query){
                    $query->where('order_status', '!=', 'Selesai')->count() == 0;})->get()->delete();
                $ord->delete();
            }
            $message = Message::where('user_id', $user->id)->get();
            foreach($message as $msg){
                $msg->delete();
            }
            $userActivity = UserActivity::where('user_id', $user->id)->get();
            foreach($userActivity as $act){
                $act->delete();
            }
            
            $user->delete();
        }
        return redirect()->route('admin.member.list')->with('seccess', 'Berhasil dihapus');
    }

    public function index(){
        $id = Auth::user()->id;
        $category = Category::all();
        $message = $this->getMessageCount($id);
        $cart_count = $this->getCartCount($id);
        $user = User::where('id', $id)->first();
        return view('Member.profile', compact('user', 'message', 'cart_count', 'category'));
    }

    public function edit(Request $request){
        $id = Auth::user()->id;
        $category = Category::all();
        $message = $this->getMessageCount($id);
        $cart_count = $this->getCartCount($id);

        $user = User::where('id', $id)->first();
        return view('Member.edit', compact('user', 'message', 'cart_count', 'category'));
    }

    public function update(Request $request){
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
        ]);

        if($request->new_password){
            $request->validate([
                'password' => ['required', new MatchOldPassword],
                'new_password' => 'required|string|min:6',
                'confirm_password' => 'same:enw_password'
            ]);
        }
        $user->username = $request->username;
        $user->email = $request->email;
        if($request->password){
            $user->password = bcrypt($request->new_password);
        }
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->updated_at = now();
        $user->save();
        return redirect()->back();
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

    protected function getInboxCount()
    {
        $inbox = Message::select('*')
            ->distinct()
            ->count('user_id');
        return $inbox;
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
