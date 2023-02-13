@extends('layouts.app')

@section('content')

<x-breadcrumb parentPageTitle="All Book" parentPageUrl="{{route('books.index')}}" currentPageTitle="Edit Book">
</x-breadcrumb>

<div class="card">
    <div class="card-header">
        <h2 class="lead text-center">Update Book</h2>
    </div>
    <div class="card-body">

        <form action="{{route('books.update', $book->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')



            <div class="row">
                <div class="form-group col-4">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$book->name}}">
                    @error("name") <span class="text-danger">{{$message}}</span> @enderror
                </div>

                <div class="form-group col-4">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug" value="{{$book->slug}}">
                </div>

                <div class="form-group col-4">
                    <label for="category_id">Category</label>
                    <select class="form-control" name="category_id" id="category_id">
                        <option value="" disabled selected>Select Category</option>
                        @foreach ($categories as $key=>$category)
                        <option value="{{$category->id}}" {{$category->id==$book->category_id ? 'selected':''}}>{{$category->name}}</option>
                        @endforeach
                        @error("category_id") <span class="text-danger">{{$message}}</span> @enderror
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="publisher name">Publisher Name</label>
                    <input type="text" class="form-control" name="publisher_name" value="{{$book->name}}">
                    @error("publisher_name") <span class="text-danger">{{$message}}</span> @enderror
                </div>

                <div class="form-group col-4" id="datepicker">
                    <label for="published_at">Published_at</label>
                    <input type="text" class="form-control" name="published_at" id="datepicker" value="{{$book->published_at}}">
                    @error("published_at") <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="form-group col-4">
                    <label for="published_at">subject</label>
                    <input type="text" class="form-control" name="subject_name" value="{{$book->subject_name}}">
                    @error("subject_name") <span class="text-danger">{{$message}}</span> @enderror
                </div>

            </div>
            <div class="row">
                <div class="form-group col-4" id="">
                    <label for="author name">Author Name</label>
                    <input type="text" class="form-control" name="author_name" value="{{$book->author_name}}">
                    @error("author_name") <span class="text-danger">{{$message}}</span> @enderror
                </div>

                <div class="form-group col-4">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="{{$book->quantity}}">
                    @error("quantity") <span class="text-danger">{{$message}}</span> @enderror
                </div>

                <div class="form-group col-4">
                    <label for="quantity">Price</label>
                    <input type="number" class="form-control" name="price" value="{{$book->price}}">
                    @error("price") <span class="text-danger">{{$message}}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-4 ">
                    <label for="image">Image</label>
                    <input type="file" class="form-control @error(" image") is-invalid @enderror" name="image" id="image" alt="image">
                    <img id="showImagePreview" src="/storage/book-image/{{ $book->image }}" alt="book image preview" height="200px" width="250px">
                    @error("image")
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group col-4">
                    <label for="quantity">Rack Number</label>
                    <input type="number" class="form-control" name="rack_number" value="{{$book->rack_number}}">
                    @error("rack_number") <span class="text-danger">{{$message}}</span> @enderror
                </div>
            </div>


            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="5" cols="5">{{$book->description}}</textarea>
                @error("description") <span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="">Trending</label>
                        <input type="checkbox" name="is_trending" style="width:50px; height:20px;" {{ $book->is_trending == '1' ?
                        'checked': '' }}>
                        @error('is_trending')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" name="status" style="width:50px; height:20px;" {{ $book->status == '1' ? 'checked': '' }}>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
</div>

@endsection


@push('inlinejs')
@section('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
    $('#category_id').select2();

    flatpickr("#datepicker", {});
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

<script>
    window.onload = function() {

        // to display image preview
        let siteImage = document.getElementById('image');
        let showImagePreview = document.getElementById('showImagePreview');
        // showImagePreview.style.display = "none";

        siteImage.onchange = evt => {
            const [file] = siteImage.files
            if (file) {
                showImagePreview.style.display = "block";
                showImagePreview.src = URL.createObjectURL(file);
                showImagePreview.onload = function() {
                    URL.revokeObjectURL(showImagePreview.src) // free memory
                }
            }
        }
    };

</script>
@endpush
