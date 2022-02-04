<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Message;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    //
    public function index(){
        $id = Auth::user()->id;
        $report = $this->getReportCount($id);
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $shippings = Shipping::all();
        return view('Admin.shipping.index', compact('shippings', 'message', 'report', 'inbox'));
    }

    public function create(){
        $id = Auth::user()->id;
        $report = $this->getReportCount($id);
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        return view('Admin.shipping.create', compact('report', 'message', 'inbox'));
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
        $report = $this->getReportCount($id);
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $shipping = Shipping::where('id', $request->id)->first();
        return view('Admin.shipping.edit', compact('shipping', 'report', 'message', 'inbox'));
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

    public function getReportCount($id){
        $report = Report::where('user_id', $id)->where('status', 0)->count();
        return $report;
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

    public function getReport(){
        $id = Auth::user()->id;
        $report = Report::where('user_id', $id)->where('status', 0)->get();
        return view('Admin.report.index', compact('report'));
    }
    
}
