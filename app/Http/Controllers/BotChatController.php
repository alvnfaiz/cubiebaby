<?php

namespace App\Http\Controllers;


use App\Models\BotChat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BotChatController extends Controller
{
    //
    public function index(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $chats = BotChat::paginate(50);
        return view('Admin.botchat.index', compact('chats', 'message', 'inbox'));
    }

    public function create(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        return view('Admin.botchat.create', compact( 'message', 'inbox'));
    }

    public function store(Request $request){
        //reply from ckeditor
        $this->validate($request, [
            'message' => 'required|string|max:255',
            'reply' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);
        BotChat::create([
            'message' => $request->message,
            'reply' => $request->reply,
            'status' => $request->status,
        ]);
        return redirect()->route('admin.botchat.index');
    }

    public function edit(Request $request){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $bot = BotChat::where('id', $request->id)->first();
        return view('Admin.botchat.edit', compact('bot', 'message', 'inbox'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'message' => 'required|string|max:255',
            'reply' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        BotChat::where('id', $request->id)->update([
            'message' => $request->message,
            'reply' => $request->reply,
            'status' => $request->status,
        ]);
        return redirect()->route('admin.botchat.index');
    }

    public function destroy(Request $request){
        BotChat::where('id', $request->id)->delete();
        return redirect()->route('admin.botchat.index');
    }

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

    
}
