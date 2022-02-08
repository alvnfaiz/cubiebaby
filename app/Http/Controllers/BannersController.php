<?php

namespace App\Http\Controllers;

use App\Models\Banner;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BannersController extends Controller
{
    //
    public function index(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $banners = Banner::all();
        return view('Admin.banner.index', compact('banners', 'message', 'inbox'));
    }

    public function create(){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        return view('Admin.banner.create', compact( 'message', 'inbox'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'alt_text' => 'required|string|max:255',
        ]);
        $banner = new Banner;
        $banner->alt = $request->alt_text;
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();  
            $banner['image'] = $request->file('image')->store('banners');
        }
        $banner->status = $request->status;
        $banner->save();
        return redirect()->route('admin.banner.index');
    }

    public function edit(Request $request){
        $id = Auth::user()->id;
        
        $message = $this->getMessageCount($id);
        $inbox = $this->getInboxCount($id);
        $banner = Banner::where('id', $request->id)->first();
        // \dd($banner);
        return view('Admin.banner.edit', compact('banner', 'message', 'inbox'));
    }

    public function update(Request $request){
        $banner = Banner::find($request->id);
        if($request->hasFile('image')){ 
            $oldImage = Banner::find($request->id);
            Storage::delete($oldImage->image);
            $imageName = time().'.'.$request->image->extension();  
            $banner['image'] = $request->file('image')->store('banners');
        }
        $banner->alt = $request->alt_text;
        $banner->status = $request->status;
        $banner->save();
        return redirect()->route('admin.banner.index');
    }

    public function delete(Request $request){
        $banner = Banner::find($request->id);
        $banner->delete();
        return redirect()->route('admin.banner.index');
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
