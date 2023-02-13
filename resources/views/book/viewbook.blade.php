@extends('layouts.app')
@section('content')
    <x-breadcrumb parentPageTitle="Return Book" parentPageUrl="{{route('return')}}"
                  currentPageTitle="User Book">
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
                                <h4 class=""><strong>Taken Quantity:</strong> {{$book->taken_quantity ?? 0}}</h4><br>
                                <h4 class=""><strong>Return Date:</strong> {{$book->return_date ?? 0}}</h4><br>
                                
                                <form action="{{route('returned')}}" method="post" id="return_form">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="return_date" id="return_date" value="{{$book->return_date}}">
                                        <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">
                                        <input type="hidden" name="book_id" id="book_id" value="{{$book->id}}">
                                        <label for="return_qty">Return Quantity</label>
                                        @if ($book->taken_quantity==2)
                                        <select class="form-control mb-2" name="return_qty" id="return_qty">
                                            <option value="" disabled selected>Select Return Quantity</option>
                                            <option value="1" selected>1</option>
                                        </select>
                                        @else
                                            
                                        <select class="form-control mb-2" name="return_qty" id="return_qty">
                                            <option value="" disabled selected>Select Return Quantity</option>
                                            <option value="1" selected>1</option>
                        
                                        </select>
                                            
                                        @endif
                                       
                                    </div>
                                    <button class="btn btn-sm btn-primary">return</button> 
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <h3 class="text-center mt-3">No Books Taken by the user</h3>
    @endforelse


@endsection
@section('scripts')
    <script>
        $('#return_form').on('submit', function() {
            setTimeout(function() {
                window.location.href = "{{URL::to('books')}}"

            }, 1000);
        });
    </script>
@endsection
