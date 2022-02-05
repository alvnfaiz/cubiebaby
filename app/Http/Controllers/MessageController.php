<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    //
    public function index(){
        $id = Auth::check()?Auth::user()->id:0;
        $message = $this->getMessageCount();
        $report = $this->getReportCount();
        $inbox = User::with('latestMessage')->get();;
        return view('Admin.pesan.index', compact( 'message', 'report', 'inbox'));


    }

    public function apiGetMessage(Request $request){
        $message = Message::where('user_id', $request->user_id)->get();
        return response()->json($message);
    }

    public function apiSendMessage(Request $request){
        $message = Message::create([
            'user_id' => $request->user_id,
            'message' => $request->message,
            'read' => false,
            'admin' => true,
        ]);
        return response()->json([
            'success' => true,
            'message' => $request->message,
            'image' => $request->image,
            'id' => $message->id,
        ]);
    }

    public function apiGetNewMessage(Request $request){
        $id = $request->user_id;
        $chats = Message::where('user_id', $id)
        ->where('read', false)
        ->where('admin', false)
        ->get();
        foreach($chats as $chat){
            $chat->read = true;
            $chat->save();
        }
        if($chats->count() > 0){
            return response()->json([
                'success' => true,
                'chats' => $chats,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
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

    public function getReportCount()
    {
        $report = Report::where('status', 'open')
            ->where('read', 0)
            ->count();
        return $report;
    }

    public function getMessageCount()
    {
        $message = Message::select('*')
        ->where('read', 0)
        ->count();
        return $message;
    }
}
