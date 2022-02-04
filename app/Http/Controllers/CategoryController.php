<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::all();
        return view('category', compact('categories'));
    }

    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
        ]);
        $category = new Category;
        $category->name = $request->name;
        $category->deskripsi = $request->deskripsi;
        $category->save();
        return redirect()->route('category.index');
    }

    public function edit(){
        return view('category.edit');
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
        ]);
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->deskripsi = $request->deskripsi;
        $category->save();
        return redirect()->route('category.index');
    }

    public function destroy(Request $request){
        $category = Category::find($request->id);
        $category->delete();
        return redirect()->route('category.index');
    }
}
