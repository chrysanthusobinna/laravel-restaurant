<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Category;
use App\Http\Requests\MenuRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function __construct()
    {
        // Share the logged-in user with all views
        view()->share('loggedInUser', Auth::User());
        
    }
    public function index()
    {
        $categories = Category::with('menus')->get(); // Load categories with menus
        return view('admin.menus', compact('categories'));
    }

    public function store(MenuRequest $request)
    {
        $validated = $request->validated();
    
        // Handle image upload
        $path = $request->file('image')->store('menus', 'public');
        $validated['image'] = $path;
    
        Menu::create($validated);
    
        return back()->with('success', 'Menu created successfully!');
    }
    

    public function update(MenuRequest $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $validated = $request->validated();
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('menus', 'public');
            $validated['image'] = $path;
        }
    
        $menu->update($validated);
    
        return back()->with('success', 'Menu updated successfully!');
    }
    

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted successfully!');
    }
}
