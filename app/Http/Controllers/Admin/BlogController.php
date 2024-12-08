<?php 
namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    // Show list of blogs
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blog', compact('blogs'));
    }

    // Store a new blog
    public function store(BlogRequest $request)
    {
        $validated = $request->validated();
    
        // Handle image upload
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('blog-images'), $imageName);
        $validated['image'] = 'blog-images/' . $imageName;
    
        Blog::create($validated);
    
        return back()->with('success', 'Blog post created successfully.');
    }
    

    // Update an existing blog
    public function update(BlogRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $validated = $request->validated();
    
        if ($request->hasFile('image')) {
            // Handle image upload
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('blog-images'), $imageName);
            $validated['image'] = 'blog-images/' . $imageName;
        } else {
            $validated['image'] = $blog->image;
        }
    
        $blog->update($validated);
    
        return back()->with('success', 'Blog post updated successfully.');
    }
    

    // Delete a blog
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image)); // Delete image file
        }
        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted successfully.');
    }
}
