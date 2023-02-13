@extends('layouts.app')

@section('content')

    <x-breadcrumb parentPageTitle="All Category" parentPageUrl="{{route('authors.index')}}"
                  currentPageTitle="Edit Category">
    </x-breadcrumb>

    <div class="card">
        <div class="card-header"><h2 class="lead text-center">Update Author</h2></div>
        <div class="card-body">

            <form action="{{route('authors.update', $author->id)}}" method= "POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$author->name}}">
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control @error("image") is-invalid @enderror" name="image" id="siteImage" alt="image">
                    @if(!is_null($author->image))
                        <img id="showImagePreview" src="{{ asset('storage/author-image/'.$author->image)}}" alt="book image preview" height="150px"
                             width="250px">
                    @else
                        <img id="showImagePreview" src="#" alt="book image preview" height="150px" width="250px" style="display: none;">
                    @endif

                    @error("image")
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>


                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>

@endsection
@section('custom_js')
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

<script>
    window.onload = function () {

        // to display image preview
        let siteImage = document.getElementById('image');
        let showImagePreview = document.getElementById('showImagePreview');
        // showImagePreview.style.display = "none";

        siteImage.onchange = evt => {
            const [file] = siteImage.files
            if (file) {
                showImagePreview.style.display = "block";
                showImagePreview.src = URL.createObjectURL(file);
                showImagePreview.onload = function () {
                    URL.revokeObjectURL(showImagePreview.src) // free memory
                }
            }
        }
    };
</script>
@endpush



