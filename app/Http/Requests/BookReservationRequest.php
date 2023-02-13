<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookReservationRequest extends FormRequest
{
    public function authorize():bool
    {
        return true;
    }

    
    public function rules()
    {
         
        $rules= [
            'book_id'=>'integer',
            'reservation_date'=>'required|date', 
        ];
        return $rules;
    }
}
