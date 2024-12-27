<?php 
namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\ImageHandlerTrait;
use App\Http\Controllers\Traits\SanitizesInputTrait;
use App\Http\Controllers\Traits\AdminViewSharedDataTrait;

class BlogController extends Controller
{

    use AdminViewSharedDataTrait;
    use ImageHandlerTrait;
    use SanitizesInputTrait;




    public function __construct()
    {
        $this->shareAdminViewData();
        
    }
    
   
    
    // Show list of blogs
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blog', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog-create');
    }

    // Store a new blog
    public function store(BlogRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $this->handleImageUpload($validated['image'], "blog-images");
        }
        $validated['content'] = $this->sanitizeHtmlContent($validated['content']);

        Blog::create($validated);
    
        return redirect()->route('admin.blog.index')->with('success', 'Blog post created successfully.');

    }
    
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog-edit', compact('blog'));
    }

    // Update an existing blog
    public function update(BlogRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $validated = $request->validated();
    
        if ($request->hasFile('image')) {
            // Delete old image
            $imagePath = storage_path('app/public/' . ltrim($blog->image, '/'));
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Handle new image upload
            $validated['image'] = $this->handleImageUpload($validated['image'],"blog-images");

        } else {
            $validated['image'] = $blog->image;
        }
        $validated['content'] = $this->sanitizeHtmlContent($validated['content']);

        $blog->update($validated);
    
        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated successfully.');

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
