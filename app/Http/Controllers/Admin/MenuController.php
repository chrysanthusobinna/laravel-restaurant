<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Category;
use App\Http\Requests\MenuRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

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
/*
    public function store(MenuRequest $request)
    {
        $validated = $request->validated();
    
        // Handle image upload
        $path = $request->file('image')->store('menus', 'public');
        $validated['image'] = $path;
    
        Menu::create($validated);
    
        return back()->with('success', 'Menu created successfully!');
    }
    */


    public function store(MenuRequest $request)
    {
        $validated = $request->validated();
        
        $image = Image::read($validated['image']);

        // Main Image Upload on Folder Code
        $imageName = time().'-'.$validated['image']->getClientOriginalName();
        $path = storage_path('app/public/menus/');
        $image->save($path.$imageName); 
        
         // Generate cropped image
         $image->cover(500, 400);
         $image->save($path.$imageName);
     
        
        $validated['image'] = "/menus/".$imageName;
    
        Menu::create($validated);
    
        return back()->with('success', 'Menu created successfully!');
    }

    public function update(MenuRequest $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $validated = $request->validated();
    
        if ($request->hasFile('image')) {

            $image = Image::read($validated['image']);

            // Main Image Upload on Folder Code
            $imageName = time().'-'.$validated['image']->getClientOriginalName();
            $path = storage_path('app/public/menus/');
            $image->save($path.$imageName); 
            
             // Generate cropped image
             $image->cover(500, 400);
             $image->save($path.$imageName);
         
            
            $validated['image'] = "/menus/".$imageName;
            //delete old image

            $imagePath = storage_path('app/public/' . ltrim($menu->image, '/'));

            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file
            }

        }
    
        $menu->update($validated);
    
        return back()->with('success', 'Menu updated successfully!');
    }
    

 

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $imagePath = storage_path('app/public/' . ltrim($menu->image, '/'));


            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file
            }
     

        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted successfully!');
    }

}
