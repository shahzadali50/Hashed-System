<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function create($id)
    {

        $category = BlogCategory::find($id);

        if (!$category) {
            return redirect()->back()->with("error", "Category not found");
        }

        return view("admin.blog.create", compact("category"));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'description' => 'required|string',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $slug = Str::slug($validatedData['title']); // Generate a URL-friendly slug.

        $blog = new Blog();
        $blog->thumbnail = $thumbnailPath;
        $blog->description = $validatedData['description'];
        $blog->title = $validatedData['title'];
        $blog->sub_title = $validatedData['sub_title'];
        $blog->slug = $slug; // Save slug in database
        $blog->category_id = $request->category_id;
        $blog->save();

        return redirect()->back()->with('success', 'Blog post created successfully.');
    }

    public function ckeditorBlogs(Request $request): JsonResponse

    {

        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('Blogs_img'), $fileName);
            $url = asset('Blogs_img/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);

        }

    }

    public function list($id){
        $category = BlogCategory::find($id);
        if (!$category) {
            return redirect()->back()->with("error", "Category not found");
        }

        $Blogs = $category->blogs()->latest()->paginate(10);
        return view('admin.blog.list',compact('Blogs','category'));

    }
    public function delete($id)
    {
        $blog = Blog::findOrFail($id);

        // Check if there is a thumbnail associated with the blog
        if ($blog->thumbnail) {
            // Delete the thumbnail from storage
            Storage::disk('public')->delete($blog->thumbnail);
        }

        // Delete the blog post itself
        $blog->delete();

        return redirect()->back()->with('success', 'Blog post deleted successfully.');
    }

    public function view($id)
{
    $blog  = Blog::with('category')->find($id);

    if ($blog ) {
        return view("admin.blog.view", compact("blog"));
    }

    return redirect()->back()->with("error", "Portfolio not found");
}

 

public function edit($id)
{
    $blog  = Blog::with('category')->find($id);

    if ($blog ) {
        return view("admin.blog.edit", compact("blog"));
    }

    return redirect()->back()->with("error", "Portfolio not found");
}
public function update(Request $request, $id)
{
    $blog = Blog::findOrFail($id);

    // Validate the request data
    $validatedData = $request->validate([
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'title' => 'required|string|max:255',
        'sub_title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    // Handle the thumbnail upload if it's provided
    if ($request->hasFile('thumbnail')) {
        // Delete the old thumbnail if it exists
        if ($blog->thumbnail && Storage::disk('public')->exists($blog->thumbnail)) {
            Storage::disk('public')->delete($blog->thumbnail);
        }

        // Save the new thumbnail path
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        $blog->thumbnail = $thumbnailPath;
    }

    // Update the fields
    $blog->title = $validatedData['title'];
    $blog->sub_title = $validatedData['sub_title'];
    $blog->description = $validatedData['description'];

    // Dynamically generate the slug based on the updated title
    $blog->slug = Str::slug($validatedData['title']);

    // Save the changes
    $blog->save();

    return redirect()->back()->with('success', 'Blog post updated successfully');
}

}
