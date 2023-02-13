@extends('layouts.app')

@section('content')

    <x-breadcrumb parentPageTitle="All books" parentPageUrl="{{ route('books.index') }}" currentPageTitle="My reservations">
    </x-breadcrumb> 
    @forelse ($books as $book)
    <div class="container">
        <div class="card ">
           
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="/storage/book-image/{{ $book->image }}" width="250" height="250">
                        </div>
                        <div class="col-md-8">
                            <h4 class=""><strong>Name:</strong> {{$book->name}}</h4><br>
                            <h4 class=""><strong>Category:</strong> {{$book->category->name}}</h4><br>
                            <h4 class=""><strong>Publisher:</strong> {{$book->publisher}}</h4><br>
                                <div class="form-group">
                                    <form action="{{route('reserved')}}" method="POST" enctype="multipart/form-data">

                                        @csrf
                                        <input type="hidden" name="book_id" id="book_id" value="{{$book->id}}">
                                        <input type="hidden" name="user_id" id="user_id" value="{{auth()->user()->id}}">
                                     
 
                                        <div class="form-group" id="datepicker">
                                            <label for="reservation_date">Reservation Date</label>
                                            <input type="text" class="form-control" name="reservation_date" id="datepicker">
                                            @error('reservation_date') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                      
                                        <button class="btn btn-primary" type="submit">Reserve</button>
                                    </form>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    <h3 class="text-center mt-3">No Reservation</h3>
@endforelse

@endsection
@section('scripts')
    <script>
        flatpickr("#datepicker", {});
        $('#user_id').select2();
    </script>
@endsection
