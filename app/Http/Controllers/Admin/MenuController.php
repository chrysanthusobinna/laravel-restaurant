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
        $categories = Category::with('menus')->get();  
        return view('admin.menus', compact('categories'));
    }

    public function store(MenuRequest $request)
    {
        $validated = $request->validated();
        
        if ($request->hasFile('image')) {
            $validated['image'] = $this->handleImageUpload($validated['image']);
        }
    
        Menu::create($validated);
    
        return back()->with('success', 'Menu created successfully!');
    }
    

    public function update(MenuRequest $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $validated = $request->validated();
    
        if ($request->hasFile('image')) {
            // Delete old image
            $imagePath = storage_path('app/public/' . ltrim($menu->image, '/'));
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
    
            // Handle new image upload
            $validated['image'] = $this->handleImageUpload($validated['image']);
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

    private function handleImageUpload($imageFile)
    {
        $image = Image::read($imageFile);
        $imageName = time() . '-' . $imageFile->getClientOriginalName();
        $path = storage_path('app/public/menus/');

        // Save Main Image
        $image->save($path . $imageName);

        // Generate cropped image
        $image->cover(500, 400);
        $image->save($path . $imageName);

        return 'menus/' . $imageName;
    }

}
