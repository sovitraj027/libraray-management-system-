 <style>
     #rating {
         color: #fd9300
     }

 </style>
 @extends('layouts.app')


 @section('content')
     <x-breadcrumb parentPageTitle="All Book" parentPageUrl="{{ route('books.index') }}" currentPageTitle="Show Book">
     </x-breadcrumb>
     <!DOCTYPE html>
     <html lang="en">
     <head>
         <meta charset="utf-8">
         <meta name="csrf-token" content="{{ csrf_token() }}">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <meta name="description" content="">
         <meta name="author" content="">
        
         <title></title>
        
     </head>

     <div class="card">
         <div class="card-header">
             @if (in_array(auth()->user()->user_type_id, [1, 2]))
                 <a href="{{ route('borrow', $book->id) }}" class="btn btn-secondary btn-sm">Borrow</a>
             @endif
         </div>
         <div class="card-body">
             <div class="container">
                 <div class="row">
                     <div class="col-md-4">
                         <img src="/storage/book-image/{{ $book->image }}" width="250" height="250">
                     </div>
                     <div class="col-md-8">
                         <div class="float-right mt-2">
                             <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                             <input type="hidden" id="book_id" name="book_id" value="{{ $book->id }}">
                            
                            @if($user_exist)
                            
                             <label for="rating" class="mt-2">Rate This Book</label>
                             <select id="rating" class="form-control mb-5" name="rating">
                                 @if (!$rating)
                                     <option value="" disabled selected>Place a rating</option>
                                     <option value="1"> &#9733;</option>
                                     <option value="2"> &#9733; &#9733;</option>
                                     <option value="3"> &#9733; &#9733; &#9733;</option>
                                     <option value="4"> &#9733; &#9733; &#9733; &#9733;</option>
                                     <option value="5"> &#9733; &#9733; &#9733; &#9733; &#9733;</option>
                                 @else
                                     <option value="1" @if ($rating->rating == 1) selected @endif> &#9733;
                                     </option>
                                     <option value="2" @if ($rating->rating == 2) selected @endif>&#9733; &#9733;
                                     </option>
                                     <option value="3" @if ($rating->rating == 3) selected @endif>&#9733; &#9733;
                                         &#9733;
                                     </option>
                                     <option value="4" @if ($rating->rating == 4) selected @endif>&#9733; &#9733;
                                         &#9733; &#9733;
                                     </option>
                                     <option value="5" @if ($rating->rating == 5) selected @endif>&#9733; &#9733;
                                         &#9733;&#9733; &#9733;
                                     </option>
                                 @endif
                             </select>
                             @endif
                    
                         </div>

                         <h4 class=""><strong>Name:</strong> {{ $book->name }}</h4><br>
                         @if(isset($avg_rating)!=null)
                             <h4 class="" style="color:#b1c70b"> Rating:{{ $avg_rating}}/5</h4><br>
                         @endif
                         <h4 class=""><strong>Category:</strong> {{ $book->category->name }}</h4><br>
                         <h4 class=""><strong>Publisher:</strong> {{ $book->publisher_name }}</h4><br>
                         <h4 class=""><strong>Published At:</strong> {{ $book->published_at }}</h4><br>
                         <h4 class=""><strong>Quantity:</strong> {{ $book->quantity }}</h4><br>
                         <h4 class=""><strong>Description:</strong> {!! $book->description !!}</h4><br>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
 @push('inlinejs')
{{-- <script src="{{ asset('assets/js/custom.js') }}"></script> --}}
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
{{-- <script>
    window.onload = function() {
    if (window.jQuery) {  
        // jQuery is loaded  
        alert("Yeah!");
    } else {
        // jQuery is not loaded
        alert("Doesn't Work");
    }
}
</script> --}}

<script>
  
    var user_id =  $('#user_id').val();
    var book_id =  $('#book_id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var rating = 0;
    $('#rating').change(function() {
        rating = $("#rating option:selected").val();
        $.ajax({
            url: "{{ route('add-rating') }}",
            type: 'POST',
            data: {
                user_id: user_id,
                rating: rating,
                book_id: book_id,
            },
        })
    });
</script>
@endpush