<?php

namespace App\Http\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Resources\MergeValue;
use Symfony\Component\Translation\Catalogue\MergeOperation;

class UserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
       
         
            $rules=[
                'name'=>'required|string',
                'email'=>'required|email|unique:users|max:30',
                'password' => 'required|min:6',
             
                ];
                if (in_array($this->method(), ['PUT', 'PATCH'])) {
                    $rules['email'] = ['email'];
                }

                if (auth()->user()->user_type_id==1) {
                    
                    $rules = array_merge($rules, [
                        'user_type_id' => 'required|integer',
                    ]);
                }
            

                return $rules;
        
                

    }
}
