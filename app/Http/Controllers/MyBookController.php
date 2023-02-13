<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyBookController extends Controller
{
    public function mybooks($id){

        $usersBooks = User::find($id)->books;

        $quantitiesWithBooks = DB::table('book_user')->where('user_id', $id)->get(['book_id','quantity','return_date']);

        foreach ($quantitiesWithBooks as $quantitiesWithBook){
            foreach ($usersBooks as $usersBook){
                if($quantitiesWithBook->book_id == $usersBook->id){
                    $usersBook['taken_quantity'] = $quantitiesWithBook->quantity;
                    $usersBook['return_date'] = $quantitiesWithBook->return_date;
                }
            }
        }

        return view('book.mybooks', [
            'books' => $usersBooks,
        ]);

    }
}
