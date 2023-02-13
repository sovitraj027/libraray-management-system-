<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookClaimRequest;
use App\Http\Requests\BookFindRequest;
use App\Http\Requests\BookReservationRequest;
use App\Http\Requests\ReservedBookFindRequest;
use App\Http\Requests\ReturnBookRequest;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

use function PHPUnit\Framework\isType;

class BookReservationController extends Controller
{
    public function Reservation($id)
    {

        return view('book.reservation.bookreservation', [

            'books' => Book::where('id', $id)->get(),
            'book_id' => $id,
        ]);
    }

    //show all user reservered books 
    public function myreservation($id)
    {

        $book_ids = DB::table('book_reservation')->where('user_id', $id)->pluck('book_id');
        $usersBooks = Book::whereIn('id', $book_ids)->get();
        $datesWithBooks = DB::table('book_reservation')->where('user_id', $id)->get(['book_id', 'reserve_date', 'reservation_date']);

        foreach ($datesWithBooks as $bookdates) {
            foreach ($usersBooks as $usersBook) {

                if ($bookdates->book_id == $usersBook->id) {

                    $usersBook['reserve_date'] = $bookdates->reserve_date;
                    $usersBook['reservation_date'] = $bookdates->reservation_date;
                }
            }
        }

        return view('book.reservation.booklist', [

            'books' => $usersBooks,
            'user_id' => $id,

        ]);
    }

    //find books by user name
    public function find()
    {
        $users = User::where('user_type_id', 3)->get();

        return view('book.reservation.findbook', \compact('users'));
    }

    //show all user reserved books
    public function userBookReservation(BookFindRequest $request)
    {
        $book_ids = DB::table('book_reservation')->where('user_id', $request->user_id)->pluck('book_id');

        $usersBooks = Book::whereIn('id', $book_ids)->get();

        $datesWithBooks = DB::table('book_reservation')->where('user_id', $request->user_id)->get(['book_id', 'reserve_date', 'reservation_date']);

        foreach ($datesWithBooks as $bookdates) {
            foreach ($usersBooks as $usersBook) {

                if ($bookdates->book_id == $usersBook->id) {

                    $usersBook['reserve_date'] = $bookdates->reserve_date;
                    $usersBook['reservation_date'] = $bookdates->reservation_date;
                }
            }
        }

        return view('book.reservation.booklist', [

            'books' => $usersBooks,
            'user_id' => $request->user_id,

        ]);
    }

    public function Reserved(BookReservationRequest $request)
    {

        $reserveDate = Carbon::now();

        $reservationDate = Carbon::parse($request->reservation_date);

        $insertData = $request->except('_token');

        if ($reservationDate < $reserveDate) {
            return redirect()->back()->with('error', 'reservation date must be after today date');
        } else {
            if (DB::table('book_reservation')->where('user_id', $request->user_id)->where('book_id', $request->book_id)->exists()) {
                return redirect()->back()->with('error', 'You already reserved this book');
            }
            if (DB::table('book_user')->where('user_id', $request->user_id)->where('book_id', $request->book_id)->exists()) {
                return redirect()->back()->with('error', 'You already borrow this book you can not reserve this book');
            } else {

                $insertData['reserve_date'] = $reserveDate;

                $insertData['reservation_date'] = $reservationDate;

                $insertData['book_id'] = $request->book_id;

                $insertData['user_id'] = $request->user_id;

                DB::table('book_reservation')->insert($insertData);

                Book::where('id', $request->book_id)->first()->decrement('quantity', 1);
            }
        }
        return redirect()->route('books.index')->with('success', 'book is reserved sucessfully');
    }

    //book borrow from reservation list
    public function claim(BookClaimRequest $request)
    {

        $borrow_date = Carbon::now()->format('Y-m-d H:i:s');
        $return_date = Carbon::parse($request->return_date);
        $insertData = $request->except('_token');
        if ($return_date < $borrow_date) {

            return redirect()->route('books.index')->with('error', 'return date must be after reservation date');
        } else {

            $insertData['borrow_date'] = $borrow_date;

            $insertData['return_date'] = $return_date;

            $insertData['book_id'] = $request->book_id;

            $insertData['user_id'] = $request->user_id;

            $insertData['librarian_id'] = auth()->user()->id;

            $insertData['quantity'] = 1;

            DB::table('book_user')->insert($insertData);

            Db::table('book_reservation')->where('user_id', $request->user_id)
                ->where('book_id', $request->book_id)->delete();

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
    }

    //cancel book user reservation
    public function cancelReservation($book_id)
    {
        $user_id = request()->user_id;

        $Date = DB::table('book_reservation')->where('book_id', $book_id)->where('user_id', $user_id)
            ->first('reservation_date');


        $today = Carbon::now()->format('Y-m-d H:i:s');

        if ($today > $Date->reservation_date && auth()->user()->user_type_id == 3) {

            return redirect()->route('books.index')->with('error', 'Cancel denied. Please contact your librarian');
        } else {



            DB::table('book_reservation')->where('book_id', $book_id)->where('user_id', $user_id)->delete();

            return redirect()->route('books.index')->with('success', 'Sucessfully cancel your reservation');
        }
    }
}
