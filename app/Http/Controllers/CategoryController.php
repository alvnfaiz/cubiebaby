<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Message;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //
    public function index(){
        $id = Auth::user()->id;
        $report = $this->getReportCount($id);
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $categories = Category::all();
        return view('Admin.category.index', compact('categories', 'message', 'report', 'inbox'));
    }

    public function create(){
        $id = Auth::user()->id;
        $report = $this->getReportCount($id);
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        return view('Admin.category.create', compact('report', 'message', 'inbox'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);
        $category = new Category;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
        return redirect()->route('admin.category.index');
    }

    public function edit(Request $request){
        $id = Auth::user()->id;
        $report = $this->getReportCount($id);
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $category = Category::where('id', $request->id)->first();
        return view('Admin.category.edit', compact('category', 'report', 'message', 'inbox'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:category,slug,'.$request->id,
        ]);
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
        return redirect()->route('admin.category.index');
    }

    public function destroy(Request $request){
        $category = Category::find($request->id);
        $category->delete();
        return redirect()->route('admin.category.index');
    }

    protected function getInboxCount($id)
    {
        $inbox = Message::select('*')
            ->distinct()
            ->count('user_id');
        return $inbox;
    }

    public function getReportCount($id)
    {
        $report = Report::where('status', 'open')
            ->where('read', 0)
            ->count();
        return $report;
    }

    public function getMessageCount($id)
    {
        $message = Message::select('*')
        ->where('read', 0)
        ->count();
        return $message;
    }
}
