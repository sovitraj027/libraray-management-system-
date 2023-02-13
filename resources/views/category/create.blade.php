@extends('layouts.app')

@section('content')

    <x-breadcrumb parentPageTitle="All Category" parentPageUrl="{{route('categories.index')}}"
                  currentPageTitle="Add New Category">
    </x-breadcrumb>

    <div class="card">
        <div class="card-header"><h2 class="lead text-center">Create a New Category</h2></div>
        <div class="card-body">

            <form action="{{route('categories.store')}}" method= "POST" enctype="multipart/form-data">
                @csrf
                     <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                        @error("name") <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" value="{{old('slug')}}">
                        </div>


                    <button class="btn btn-primary" type="submit">Create</button>
            </form>

        </div>
    </div>

@endsection
@section('custom_js')
    <script>
        $(document).ready(function () {
            $("#name").keyup(function () {
                var Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
                $("#slug").val(Text);
            });
        });
    </script>
@endsection
