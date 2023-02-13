<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookClaimRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       
        $rules= [
            'user_id'=>'integer',
            'book_id'=>'integer',
           
            'return_date'=>'required|date'
            //
        ];
   
        return $rules;
    }
}