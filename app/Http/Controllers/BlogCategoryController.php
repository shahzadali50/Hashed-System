<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index(){
        $categories = BlogCategory::orderBy('id', 'desc')->paginate(10);
        return view('admin.blog_category.list', compact('categories'));


    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:portfolio_categories|max:255',
        ]);

        BlogCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->back()->with('success', 'Category Added Successfully!');
    }
    public function delete($id)
    {
        BlogCategory::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Category Deleted Successfully!');
    }

    public function edit($id)
    {
        $category = BlogCategory::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found!');
        }

        return view('admin.portfolio.category-edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Find category
        $category = BlogCategory::find($id);

        // Check if category exists
        if (!$category) {
            return redirect()->route('admin.blogs.categories')->with('error', 'Category not found.');
        }

        // Validate request
        $request->validate([
            'name' => 'required|string|max:255|unique:portfolio_categories,name,' . $id,
        ]);

        // Update category with name & slug
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Category updated successfully.');
    }
}
