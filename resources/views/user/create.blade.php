@extends('layouts.app')

@section('content')

    <x-breadcrumb parentPageTitle="All Users" parentPageUrl="{{ route('users.index') }}" currentPageTitle="Add new user">
    </x-breadcrumb>

    <div class="card">
        <div class="card-header">
            <h2 class="lead text-center">Create a New User</h2>
        </div>
        <div class="card-body">

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="contact">Password</label>
                    <input type="password" class="form-control" name="password" id="password"
                        value="{{ old('password') }}">
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">

                    @if (auth()->user()->user_type_id == 1)
                        <label for="user_type_id">User Type</label>
                        <select class="form-control" name="user_type_id" id="user_type_id">
                            <option value="2">Librarian</option>
                            <option value="3">Member</option>
                        </select>
                    @endif

                </div>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>

        </div>
    </div>

@endsection
@section('custom_js')
    <script>
        $(document).ready(function() {
            $("#name").keyup(function() {
                var Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
                $("#slug").val(Text);
            });
        });
    </script>
@endsection
