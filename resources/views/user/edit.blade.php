@extends('layouts.app')

@section('content')

    <x-breadcrumb parentPageTitle="All users" parentPageUrl="{{route('users.index')}}"
                  currentPageTitle="Edit User">
    </x-breadcrumb>

    <div class="card">
        <div class="card-header"><h2 class="lead text-center">Update User</h2></div>
        <div class="card-body">

            <form action="{{route('users.update', $user->id)}}" method= "POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                   <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                        @error("name") <span class="text-danger">{{$message}}</span> @enderror

                        </div>

                        <div class="form-group">
                        <label for="slug">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}">
                        @error("email") <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            @if(auth()->user()->user_type_id==1)
                            <label for="user_type_id">User Type</label>
                            <select class="form-control" name="user_type_id" id="user_type_id">
                                <option value="2">Librarian</option>
                                <option value="3">Member</option>
                            </select> 
                            @endif
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" name="password" id="password" >
                                @error("password") <span class="text-danger">{{$message}}</span> @enderror
                                </div>

                    <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>

@endsection
