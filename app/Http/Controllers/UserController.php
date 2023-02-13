<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
  
    public function index()
    {
        if(auth()->user()->user_type_id==1){
            
         $users=User::latest()->get();
        }

     else{

            $users=User::where('user_type_id',3)->get();

           }

        return view('user.index',\compact('users'));
    
    }

    
    
     public function create(){

       $id = Auth::user()->user_type_id;  

        return view('user.create',\compact('id'));
        
        }
    

    
    public function store(UserRequest $request)
    {
    
        $data = $request->except('_token');

        if(auth()->user()->user_type_id==2){

            $data['user_type_id']=3;
        }  

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

         return redirect()->route('users.index')->with('success', 'user Created Successfully!');
    }

   
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {

        return view('user.edit', compact('user'));

    }
    
    public function update(UserRequest $request, User $user) 
    {  
            $data = $request->except('_token');

            if(auth()->user()->user_type_id==2){

            $data['user_type_id']=3;

        }
        
        $data['password'] = Hash::make($data['password']);

            $user->update($data);

            return redirect()->route('users.index')->with('info', 'user Updated Successfully!');

    }

    public function destroy(USer $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('error', 'user Deleted Successfully!');
    }
}
