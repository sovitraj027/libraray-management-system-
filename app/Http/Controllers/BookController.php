<?php

namespace App\Http\Controllers;

use App\Http\Requests\book_user_Request;
use App\Models\Book;
use App\Http\Requests\BookRequest;
use App\Http\Requests\BookUserRequest;
use App\Http\Requests\borrow_book_Request;
use App\Imports\BooksImport;
use App\Models\book_history;
use App\Models\Book_user;
use App\Models\Category;
use App\Models\Rating;
use App\Models\User;
use App\Traits\FileUploadTrait;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use PDF;


class BookController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return view('book.index', [

            'books' => Book::latest()->get(),
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('book.create', \compact('categories'));
    }

    public function store(BookRequest $request)
    {
    
        $book = Book::create($request->except('image','is_trending','status'));
        $book->status=$request->status == true ? '1':'0';
        $book->is_trending=$request->is_trending == true ? '1':'0';
        $book->save();

        if ($request->hasFile('image')) {

            $this->fileUpload($book, 'image', 'book-image', false);
        }

        return redirect()->route('books.index')->with('success', 'Book Created Successfully!');
    }


    public function show(Book $book)
    {

        $rating = Rating::where('user_id', auth()->id())->where('book_id', $book->id)->first();

        if ($rating == null) {
            $rating = 0;

        }
        return view('book.show', [
            'book' => $book->load('category'),
            'rating'=>$rating,
            'avg_rating'=> Rating::where('book_id', $book->id)->pluck('rating')->avg(),
            'user_exist'=>book_history::where('user_id',Auth::user()->id)->where('book_id',$book->id)->exists()
            
        ]);
    }

    public function edit(Book $book)
    {

        $categories = Category::all();

        return view('book.edit', compact('book', 'categories'));
    }

    public function update(BookRequest $request, Book $book)
    {
        $book->update($request->except('image,','status','is_trending'));
         $book->status=$request->status == true ? '1':'0';
         $book->is_trending=$request->is_trending == true ? '1':'0';
         $book->update();

        if ($request->hasFile('image')) {
            if (!is_null($book->image)) {

                $this->fileUpload($book, 'image', 'book-image', true);
            }
            $this->fileUpload($book, 'image', 'book-image', false);
        }

        return redirect()->route('books.index')->with('info', 'Book Updated Successfully!');
    }

    public function borrowbook($id)
    {

        $members = User::where('user_type_id', 3)->get();

        return view('book.borrow', compact('members', 'id'));
    }

    public function borrowed(BookUserRequest $request)
    {
        // dd($request->all());
        if (DB::table('book_user')->where('user_id', $request->user_id)->where('book_id', $request->book_id)->exists()) {
            return redirect()->back()->with('info', 'User already has this book!');
        }

        if (Book::where('id', $request->book_id)->first()->quantity < (int)$request->quantity) {
            return redirect()->back()->with('info', 'Requested quantity is more than available');
        } else {
            Book::where('id', $request->book_id)->first()->decrement('quantity', (int)$request->quantity);
        }
        if ((DB::table('book_histories')->where('book_id', $request->book_id)->exists())) {
            DB::table('book_histories')->where('book_id', $request->book_id)->increment('quantity', (int)$request->quantity);
        } else {
            DB::table('book_histories')->insert($request->except( '_method', 'borrow_date', 'return_date', '_token', 'librarian_id'));
        }

        DB::table('book_user')->insert($request->validated());

        $userbook = DB::table('book_user')->where('user_id', $request->user_id)->where('book_id', $request->book_id)->first(['quantity', 'borrow_date', 'return_date']);

        $userData = User::where('id', $request->user_id)->first(['name', 'email']);

        $bookName = Book::where('id', $request->book_id)->first('name');

        $data = [
            'book' => $userbook,
            'userinfo' => $userData,
            'bookName' => $bookName

        ];

        $pdf = PDF::loadView('book.pdf', $data);

        return $pdf->download('book.pdf');
    }

    public function destroy(Book $book)
    {
        Storage::delete('public/book-image/' . $book->image);

        $book->delete();

        return redirect()->route('books.index')->with('error', 'Book Deleted Successfully!');
    }

    //book excel
    public function bookimport()
    {

        return view('book.view');
    }
    public function fileImport(Request $request)
    {

        Excel::import(new BooksImport, $request->file);
        return redirect()->route('books.index')->with('success', 'Book added Successfully!');
    }
}
