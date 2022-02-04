<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotChatController extends Controller
{
    //
    public function index(){
        $id = Auth::user()->id;
        $report = $this->getReportCount($id);
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $chats = BotChat::all();
        return view('Admin.botchat.index', compact('chats', 'message', 'report', 'inbox'));
    }

    public function create(){
        $id = Auth::user()->id;
        $report = $this->getReportCount($id);
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        return view('Admin.botchat.create', compact('report', 'message', 'inbox'));
    }

    public function store(Request $request){
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
        $report = $this->getReportCount($id);
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $chat = BotChat::where('id', $request->id)->first();
        return view('Admin.botchat.edit', compact('chat', 'report', 'message', 'inbox'));
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

    public function getReportCount($id){
        $report = Report::where('user_id', $id)->count();
        return $report;
    }

    public function getMessageCount($id){
        $message = Message::where('user_id', $id)->count();
        return $message;
    }

    public function getInboxCount($id){
        $inbox = Inbox::where('user_id', $id)->count();
        return $inbox;
    }

    
}
