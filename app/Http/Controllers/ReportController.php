<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //

    public function index(){
        $id = Auth::user()->id;
        $message = $this->getMessageCount($id);
        $inbox = $this->getCartCount($id);
        $reports = Report::paginate(20);
        return view('Admin.report.index', compact( 'message', 'inbox', 'reports'));
    }

    public function create(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getCartCount($id);
        return view('Admin.report.create', compact( 'message', 'inbox'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $report = new Report;
        $report->title = $request->title;
        $report->description = $request->description;
        $report->image = $request->image;
        $report->save();

        return redirect()->route('admin.report.index');
    }

    public function indexAdmin(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getCartCount($id);
        $reports = Report::paginate(20);
        return view('Admin.report.index', compact( 'message', 'inbox', 'reports'));
    }

    public function replyReport(Request $request){
        $request->validate([
            'reply' => 'required',
        ]);

        $report = Report::where('id', $request->id)->first();
        $report->reply = $request->reply;
        $report->save();

        return redirect()->route('admin.report.index');
    }
}
