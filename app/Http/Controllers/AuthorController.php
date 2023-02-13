<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Author;
use App\Models\Category;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    use FileUploadTrait;
    public function index()
    {
        return view('author.index', [

            'authors' => Author::latest()->where('status',1)->get()

        ]);
    }

    public function create()
    {
        return view('author.create');
    }

    public function store(AuthorRequest $request)
    {
        $author = Author::create($request->except('image'));

        if ($request->hasFile('image')) {

            $this->fileUpload($author, 'image', 'author-image', false);
        }

        return redirect()->route('authors.index')->with('success', 'Author Created Successfully!');
    }

//    public function show(Category $category)
//    {
//        return view('category.show', compact('category'));
//
//    }

    public function edit(Author $author)
    {
        return view('author.edit', compact('author'));

    }

    public function update(AuthorRequest $request, Author $author)
    {
        $author->update($request->except('image'));

        if ($request->hasFile('image')) {
            if (!is_null($author->image)) {

                $this->fileUpload($author, 'image', 'author-image', true);
            }
            $this->fileUpload($author, 'image', 'author-image', false);
        }

        return redirect()->route('authors.index')->with('info', 'Author Updated Successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('error', 'Category Deleted Successfully!');
    }
}
