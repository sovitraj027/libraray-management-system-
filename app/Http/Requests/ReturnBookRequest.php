<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReturnBookRequest extends FormRequest
{
  
    public function authorize():bool
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'user_id'=>'integer',
            'book_id'=>'integer',
            'return_qty'=>'integer'
        ];
    }
}
