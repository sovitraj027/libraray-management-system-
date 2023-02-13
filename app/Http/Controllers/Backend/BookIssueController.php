<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BookIssueController extends Controller
{
   public function BookIssue(){
 
    return  view('book.issue.create',
    [
        'users'=>User::where('user_type_id','3')->get()
    ]);
   }
}
