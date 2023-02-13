<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookReservationRequest;
use App\Models\Book;
use App\Models\book_reservation;
use App\Models\Category;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        $users = User::where('user_type_id', '!=', '1')->count();

        $categories = Category::count();

        $quantity = DB::table('book_user')->sum('quantity');

        $books = Book::count();

        $reservation = DB::table('book_reservation')->count();

        $allbooks = Book::all();

        $chartData = "";

        $chartData .= "['" . 'books' . "'," . $books . "],['" . 'books taken' . "'," . $quantity . "],['" . 'Registered users' . "'," . $users . "],['" . 'Available categories' . "'," . $categories . "],['" . 'Reserved books' . "'," . $reservation . "]";


        $arr['chartData'] = rtrim($chartData, ",");




        return view('home', \compact('users', 'categories', 'books', 'allbooks', 'quantity', 'arr'));
    }

    public function recommendation()
    {
        $book_id = DB::table('book_histories')->where('user_id', auth()->user()->id)->pluck('book_id');
        $category_Ids = Book::whereIn('id', $book_id)->pluck('category_id');
        $book1 = Book::whereIn('category_id', $category_Ids)
            ->where('is_trending', 1)
            ->where('status', '1')->get();
        $book_Ids = Rating::where('rating', '>', '3')->pluck('book_id');
        $book2 = Book::whereIn('id', $book_Ids)->get();
        $books = $book1->merge($book2);

        return view(
            'book.recommendation',
            [
                'books' => $books,
            ]
        );
    }


    public function  searchBooks()
    {
        return view('book.search.index', [
            'categories' => Category::all()
        ]);
    }

    public function filter(Request $filters)
    {
        $book = (new Book)->newQuery();

        // if ($filters->has('name')) {
        //     $book->where('name', $filters->input('name'));
        // }
        if ($filters->has('category')) {

            $book->whereHas(
                'category',
                function ($query) use ($filters) {
                    $query->where('categories.name', $filters->input('category'));
                }
            );
        }
        $book->get();
    }


    // public function github(){
    //     dd('here');
    // }


}
