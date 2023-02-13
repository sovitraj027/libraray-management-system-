<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
        $rules=[
            'book_id'=>'integer',
            'user_id'=>'required|integer',
            'borrow_date'=>'required|date',
            'return_date'=>'required|date|after:borrow_date',
            'quantity'=>'required|integer',
            'librarian_id'=>'required|integer'

        ];
        return $rules;
        
    }
}
