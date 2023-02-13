<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function addRating(Request $request)
        {
         
            
            Rating::updateOrCreate(
                ['user_id' => $request->user_id, 'book_id' => $request->book_id],
                ['rating' => $request->rating,]
            );
        }
}
