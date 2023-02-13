<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book_find_Request;
use App\Http\Requests\BookFindRequest;
use App\Http\Requests\Return_Book_Request;
use App\Http\Requests\ReturnBookRequest;
use App\Models\Book;
use App\Models\Book_user;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReturnBookController extends Controller
{

    public function returnbook()
    {
        $users = User::where('user_type_id', 3)->get();

        return view('book.return', \compact('users'));
    }

    public function viewbook(BookFindRequest $request)
    {
         
        $usersBooks = User::find($request->user_id)->books;

        $quantitiesWithBooks = DB::table('book_user')->where('user_id', $request->user_id)->get(['book_id','quantity','return_date']);

        foreach ($quantitiesWithBooks as $quantitiesWithBook){
            foreach ($usersBooks as $usersBook){
                if($quantitiesWithBook->book_id == $usersBook->id){
                    $usersBook['taken_quantity'] = $quantitiesWithBook->quantity;
                    $usersBook['return_date'] = $quantitiesWithBook->return_date;
                }
            }
        }

        return view('book.viewbook', [
            'books' => $usersBooks,
            'user_id'=>$request->user_id
        ]);
    }

    public function returned(ReturnBookRequest $request)
    {
     
        $return_date = Carbon::parse($request->return_date);
        $current_date = Carbon::now();

        $return_quanttityOne=DB::table('book_user')->where('user_id', $request->user_id)
        ->where('book_id', $request->book_id)->first()->quantity==1;

        $return_quanttityTwo=DB::table('book_user')->where('user_id', $request->user_id)
        ->where('book_id', $request->book_id)->first()->quantity==2;

        //for return pdf
        $userbook=DB::table('book_user')->where('user_id', $request->user_id)->where('book_id', $request->book_id)->first(['return_date']); 
        
        $userData=User::where('id', $request->user_id)->first(['name','email']);
        
        $bookName = Book::where('id', $request->book_id)->first('name');

       

        //when book is returned into library  earlier
        if($return_date>$current_date ){                                     
            
            if($return_quanttityOne){
             
                DB::table('book_user')->where('user_id', $request->user_id)->where('book_id', $request->book_id)->delete();
 
                Book::where('id', $request->book_id)->first()->increment('quantity', (int)$request->return_qty);

                $data=[
                    'book'=>$userbook,
                    'userinfo'=>$userData,
                    'bookName'=>$bookName,
                    'submitDate'=>$current_date,
                    'quantity'=>$request->return_qty
                    
                ];

                $pdf = PDF::loadView('book.returnpdf',$data);

                return $pdf->download('book.pdf');
            }
            else{

                DB::table('book_user')->where('user_id', $request->user_id)->where('book_id', $request->book_id)
                ->decrement('quantity',(int)$request->return_qty);

                Book::where('id', $request->book_id)->first()->increment('quantity', (int)$request->return_qty);

                $data=[
                    'book'=>$userbook,
                    'userinfo'=>$userData,
                    'bookName'=>$bookName,
                    'quantity'=>$request->return_qty,
                    'submitDate'=>$current_date,
                    'fine'=>0
                ];

                $pdf = PDF::loadView('book.returnpdf',$data);

                return $pdf->download('book.pdf');

            }
        }

        //when return quantity is 1 and late submission
        elseif($return_date<$current_date){

            $days=$return_date->diffInDays($current_date);
            
            $fine= 5 * $days;
            
            if($return_quanttityOne){
         
                DB::table('book_user')->where('user_id', $request->user_id)->where('book_id', $request->book_id)->delete();

                Book::where('id', $request->book_id)->first()->increment('quantity', (int)$request->return_qty);
                $data=[
                    'book'=>$userbook,
                    'userinfo'=>$userData,
                    'bookName'=>$bookName,
                    'submitDate'=>$current_date,
                    'fine'=>$fine,
                    'quantity'=>$request->return_qty
                ];

                $pdf = PDF::loadView('book.returnpdf',$data);

                return $pdf->download('book.pdf');
            }
            else{

                DB::table('book_user')->where('user_id', $request->user_id)->where('book_id', $request->book_id)
                ->decrement('quantity',(int)$request->return_qty);

                Book::where('id', $request->book_id)->first()->increment('quantity', (int)$request->return_qty);

                $data=[
                    'book'=>$userbook,
                    'userinfo'=>$userData,
                    'bookName'=>$bookName,
                    'submitDate'=>$current_date,
                    'quantity'=>$request->return_qty,
                    'fine'=>$fine
                ];

                $pdf = PDF::loadView('book.returnpdf',$data);

                return $pdf->download('book.pdf');
            }
        }
        //when return quantity is 2 and early submission        
            elseif($return_date>$current_date){
                
                if($return_quanttityTwo){

                    DB::table('book_user')->where('user_id', $request->user_id)->where('book_id', $request->book_id)->delete();

                    Book::where('id', $request->book_id)->first()->increment('quantity', (int)$request->return_qty);

                    $data=[
                        'book'=>$userbook,
                        'userinfo'=>$userData,
                        'bookName'=>$bookName,
                        'submitDate'=>$current_date,
                        
                    ];

                    $pdf = PDF::loadView('book.returnpdf',$data);

                    return $pdf->download('book.pdf');

                }
               
            }
            //when return quantitu is 2 and late submission

            elseif($return_date<$current_date){

                $days=$return_date->diffInDays($current_date);
            
                $fine= 5 * $days;
                
                if($return_quanttityTwo){

                    DB::table('book_user')->where('user_id', $request->user_id)->where('book_id', $request->book_id)->delete();

                    Book::where('id', $request->book_id)->first()->increment('quantity', (int)$request->return_qty);

                    $data=[
                        'book'=>$userbook,
                        'userinfo'=>$userData,
                        'bookName'=>$bookName,
                        'submitDate'=>$current_date,
                        'quantity'=>$request->return_qty,
                        'fine'=>$fine
                    ];

                    $pdf = PDF::loadView('book.returnpdf',$data);

                    return $pdf->download('book.pdf');
                }
                

            }

            }
}