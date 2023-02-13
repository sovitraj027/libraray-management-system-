<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MyBookController;
use App\Http\Controllers\ReturnBookController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RatingController;
use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\BookIssueController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});
//Register field is hidden.
Auth::routes(['register' => false]);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/sign-in/github', [LoginController::class, 'github'])->name('sign-in.github');
    Route::get('/sign-in/github/redirect', [\App\Http\Controllers\Auth\LoginController::class, 'githubRedirect']);
});

    Route::group(['middleware' => 'auth'], function () {
    Route::post('add-rating', [RatingController::class, 'addRating'])->name('add-rating');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    route::get('/recommendation',[App\Http\Controllers\HomeController::class, 'recommendation'])->name('recommendation');
    route::get('/books/search',[App\Http\Controllers\HomeController::class, 'searchBooks'])->name('search_books');
    route::get('/search',[App\Http\Controllers\HomeController::class, 'filter'])->name('search');
    Route::resource('books', BookController::class);

    Route::get('/profile',[ProfileController::class,'profile'])->name('profile');

    Route::get('/mybooks/{id}', 'App\Http\Controllers\MyBookController@mybooks')->name('mybook');
    
//book reservation
    Route::get('/bookReservation/{id}', 'App\Http\Controllers\BookReservationController@reservation')->name('bookreservation');
    Route::post('/bookreserved', 'App\Http\Controllers\BookReservationController@reserved')->name('reserved');
    Route::get('/myreservation/{id}', 'App\Http\Controllers\BookReservationController@myreservation')->name('myreservation');
    Route::get('find/books', 'App\Http\Controllers\BookReservationController@find')->name('find');
    Route::post('reserved/books', 'App\Http\Controllers\BookReservationController@userBookReservation')->name('userbook');
    Route::post('cancel/{book_id}', 'App\Http\Controllers\BookReservationController@cancelReservation')->name('cancel');


    Route::group(['middleware' => 'librarian'], function () {

        Route::resource('users', UserController::class);
        Route::get('books/borrow/{id}', 'App\Http\Controllers\BookController@borrowbook')->name('borrow');
        Route::get('/import', 'App\Http\Controllers\BookController@bookimport')->name('import');
        Route::post('book/import', 'App\Http\Controllers\BookController@fileImport')->name('file-import');
        Route::post('books/save', 'App\Http\Controllers\BookController@borrowed')->name('save');
        Route::get('return/books', 'App\Http\Controllers\ReturnBookController@returnbook')->name('return');
        Route::post('return/viewbook', 'App\Http\Controllers\ReturnBookController@viewbook')->name('viewbook');
        Route::post('returned/books', 'App\Http\Controllers\ReturnBookController@returned')->name('returned');
        Route::post('claim/books', 'App\Http\Controllers\BookReservationController@claim')->name('claim');

    });

    Route::group(['middleware' => 'admin'], function () {
        Route::get('book/issue', [BookIssueController::class,'BookIssue'])->name('bookIssue');
        Route::Resource('authors', \App\Http\Controllers\AuthorController::class);
        Route::Resource('categories', CategoryController::class);
    });
});
