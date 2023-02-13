@extends('layouts.app')
@section( 'content')
@include('book.style.booklisting')
<div class="container">

    @foreach ($books as $key=>$book)

    <div class="card">
        <div class="card-header">
            <img src="/storage/book-image/{{ $book->image }}" alt="rover" />
        </div>

        <div class="card-body">

            <span class="tag tag-teal ">{{$book->category->name}}</span>

            <div class="">

                @if(isset($book->rating)!=null)
                <div class="rating">
                    &#9733; &#9733; &#9733; &#9733; &#9733;
                </div>
                Rating:{{$book->rating->rating}}
                @else
                Rating: N/A
                @endif
            </div>

            <h4>
                {{$book->name}}
            </h4>
            <p>
                {!! Str::limit($book->description, 50) !!} <a href="{{ route('books.show', $book->id) }}">View
                    Detail</a>
            </p>
            <p>
                <a href="{{ route('bookreservation', $book->id) }}" class="btn btn-primary btn-sm"><i
                        class="fas fa-plus-square"></i> Reserve this</a>
            </p>
            <div class="user">
                <img src="https://cdn.pixabay.com/photo/2013/07/13/10/07/man-156584_960_720.png" alt="user" />
                <div class="user-info">
                    <h5>{{$book->author_name}}</h5>
                    <small>Published At:{{$book->published_at}}</small>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection
