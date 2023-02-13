<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index', [

            'categories' => Category::latest()->get()

        ]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('categories.index')->with('success', 'Category Created Successfully!');
    }

    public function show(Category $category)
    {
        return view('category.show', compact('category'));

    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));

    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('categories.index')->with('info', 'Category Updated Successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('error', 'Category Deleted Successfully!');
    }
}
