<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        // Share the logged-in user with all views
        view()->share('loggedInUser', Auth::User());
        
    }
    

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create(['name' => $request->name]);
        return redirect()->back()->with('success', 'Category created successfully.');
    }
    

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update(['name' => $request->name]);
        return redirect()->back()->with('success', 'Category updated successfully.');
    }
    

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }


}
