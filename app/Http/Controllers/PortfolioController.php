<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Models\PortfolioCategory;

class PortfolioController extends Controller
{
    public function create($id)
    {
        $category = PortfolioCategory::find($id);

        if ($category) {
            return view("admin.portfolio.create-portfolio", compact("category"));
        }

        return redirect()->back()->with("error", "Category not found");
    }
    public function list($id)
    {
        $category = PortfolioCategory::find($id);

        if (!$category) {
            return redirect()->back()->with("error", "Category not found");
        }

        $portfolios = $category->portfolios()->latest()->paginate(10); 

        return view("admin.portfolio.portfolio-list", compact("category", "portfolios","category"));
    }
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('portfolio', 'public');
        } else {
            $imagePath = null;
        }

        // Save data in the database
        Portfolio::create([
            'category_id' => $request->category_id, // Make sure to include this hidden field in the form
            'image' => $imagePath,
            'title' => $request->title,
            'name' => $request->description,
            'category_id' => $request->category_id,
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Portfolio created successfully.');
    }
    public function delete(Request $request)
    {
        $portfolio = Portfolio::find($request->id);
        if ($portfolio) {
            $portfolio->delete();
            return redirect()->back()->with('success', 'Portfolio deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error', 'Portfolio not found.');
        }

    }

    public function edit($id)
    {
        $portfolio = Portfolio::with('category')->find($id);

        if ($portfolio) {
            return view("admin.portfolio.portfolio-edit", compact("portfolio"));
        }

        return redirect()->back()->with("error", "Portfolio not found");
    }

    public function update(Request $request, $id)
{
    $portfolio = Portfolio::find($id);

    if (!$portfolio) {
        return redirect()->back()->with('error', 'portfolio not found.');
    }

    $validatedData = $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
    ]);

    // Handle Image Upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($portfolio->image && file_exists(storage_path('app/public/' . $portfolio->image))) {
            unlink(storage_path('app/public/' . $portfolio->image));
        }

        // Store new image
        $imagePath = $request->file('image')->store('portfolio', 'public');
        $validatedData['image'] = $imagePath;
    }

    // Update portfolio
    $portfolio->update($validatedData);

    return redirect()->back()->with('success', 'Portfolio updated successfully.');
}



}
