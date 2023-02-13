<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'=>'required|string',
            'slug'=>'required|string',
            'image'=>'nullable',
            'description' => 'required|string',
            'publisher_name'=>'required',
            'author_name'=>'required|string',
            'subject_name'=>'required|string',
            'published_at'=>'required|date',
            'quantity'=>'required|integer',
            'price'=>'required|integer',
            'rack_number'=>'required',
            'category_id'=>'required',
            'is_trending'=>'nullable',
            'status'=>'nullable'
            ];
    }

    public function messages()
    {
    return [
    'category_id.required' => 'Category is required!',

    ];
    }
}
