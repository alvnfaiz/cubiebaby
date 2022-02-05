<?php

namespace App\Http\Controllers;


use App\Models\BotChat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMessageController extends Controller
{
    //
    public function index(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $chats = Message::where('user_id', $id)->get();
        return view('Member.pesan.index', compact('chats', 'message', 'cart_count'));
    }

    public function adminMessageUpdate(Request $request){
        $message = Message::find($request->id);
        $message->read = 1;
        $message->save();
        return response()->json($message);
    }

    public function apiSend(Request $request){
        $message = new Message();
        Message::create([
            'user_id' => Auth::user()->id,
            'image' => $request->image,
            'message' => $request->message,
            'read' => false,
            'admin' => false,
        ]);
        //select from table botchat where message like request->messsage
        $bot = BotChat::where('message', 'like', '%'.$request->message.'%')->first();
        $reply = false;
        if($bot){
            Message::create([
                'user_id' => Auth::user()->id,
                'message' => $bot->reply,
                'read' => false,
                'admin' => true,
            ]);
            $reply = $bot->reply;
        }
        return response()->json([
            'success' => true,
            'message' => $request->message,
            'image' => $request->image,
            'id' => $message->id,
            'reply' => $reply,
            
        ]);
        event(new Pesan($request->message, $request->user_id));
    }

    public function apiGetMessage(Request $request){
        $id = Auth::user()->id;
        $chats = Message::where('user_id', $id)->get();
        return response()->json([
            'success' => true,
            'chats' => $chats,
        ]);
    }

    //new message
    public function apiGetNewMessage(Request $request){
        $id = Auth::user()->id?:$request->user_id;
        $chats = Message::where('user_id', $id)
        ->where('read', false)
        ->where('admin', true)
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



    public function getMessageCount($id)
    {
        $message = Message::select('*')
        ->where('read', 0)
        ->count();
        return $message;
    }
}
