<?php

namespace App\Http\Controllers;

use App\Models\BotChat;
use App\Models\Message;
use App\Models\Broadcast;
use Illuminate\Http\Request;
use App\Models\BroadcastRecipient;

class BroadcastController extends Controller
{
    public function index(){
        $message = $this->getMessageCount();
        $inbox = $this->getInboxCount();
        $chats = Broadcast::with('recipient')->paginate(50);
        //get every recipient username
        $recipients = [];
        foreach($chats as $chat){
            foreach($chat->recipient as $recipient){
                $recipients[] = $recipient->user->username;
            }
        }
        // dd($chats);
        return view('Admin.broadcast.index', compact('chats', 'message', 'inbox'));
    }

    public function create(){
        $message = $this->getMessageCount();
        $inbox = $this->getInboxCount();
        return view('Admin.Broadcast.create', compact( 'message', 'inbox'));
    }

    public function store(Request $request){
        //foreach checkbock receiver
        $this->validate($request, [
            'value' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'receiver' => 'required',
        ]);

        $image = null;
        if($request->hasFile('image')){ 
            $image = $request->file('image')->store('bc');
        }

        $broadcast = Broadcast::create([
            'value' => $request->value,
            'image' => $image,
            'send_at' => now(),
        ]);

        foreach($request->receiver as $receiver){
            BroadcastRecipient::create([
                'broadcast_id' => $broadcast->id,
                'user_id' => $receiver,
            ]);
            Message::create([
                'user_id' => $receiver,
                'message' => $request->value,
                'image' => $image,
                'admin' => 1,
                'read' => 0,
                'created_at' => now(),
            ]);
        }
        return redirect()->route('admin.broadcast.index');

    }

    protected function getInboxCount()
    {
        $inbox = Message::select('*')
            ->distinct()
            ->count('user_id');
        return $inbox;
    }


    public function getMessageCount()
    {
        $message = Message::select('*')
        ->where('read', 0)
        ->count();
        return $message;
    }
}
