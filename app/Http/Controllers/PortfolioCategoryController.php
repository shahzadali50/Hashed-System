<?php

namespace App\Http\Controllers;

use Str;
use Illuminate\Http\Request;
use App\Models\PortfolioCategory;

class PortfolioCategoryController extends Controller
{
    public function PortfolioCategories(){
        $categories = PortfolioCategory::orderBy('id', 'desc')->get();
        return view('admin.portfolio.category', compact('categories'));


    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:portfolio_categories|max:255',
        ]);

        PortfolioCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->back()->with('success', 'Category Added Successfully!');
    }
    public function delete($id)
    {
        PortfolioCategory::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Category Deleted Successfully!');
    }
    public function edit($id)
    {
        $category = PortfolioCategory::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found!');
        }

        return view('admin.portfolio.category-edit', compact('category'));
    }
    public function update(Request $request, $id)
{
    // Find category
    $category = PortfolioCategory::find($id);

    // Check if category exists
    if (!$category) {
        return redirect()->route('admin.portfolio.categories')->with('error', 'Category not found.');
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
