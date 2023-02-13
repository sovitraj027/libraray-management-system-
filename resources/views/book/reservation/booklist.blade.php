@extends('layouts.app')
@section('content')
    <x-breadcrumb parentPageTitle="All books" parentPageUrl="{{ route('books.index') }}" currentPageTitle="My Reservation">
    </x-breadcrumb>
    @forelse ($books as $book)
        <div class="container">
            <div class="card ">


                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="/storage/book-image/{{$book->image }}" width="250" height="250">
                            </div>
                            <div class="col-md-8">
                                <h4 class=""><strong>Name:</strong> {{ $book->name }}</h4><br>
                                <h4 class=""><strong>Category:</strong> {{ $book->category->name }}</h4><br>

                                <h4 class=""><strong>Reserved Date:</strong> {{ \Carbon\Carbon::parse( $book->reserve_date ?? 0)->format('Y-m-d')}}
                                </h4><br>
                                <h4 class=""><strong>Reservation date</strong> {{ \Carbon\Carbon::parse( $book->reservation_date ?? 0)->format('Y-m-d') }}</h4>
                                <br>
                                @if(auth()->user()->user_type_id==1||auth()->user()->user_type_id==2)
                                    <form action="{{route('claim')}}" method="POST" enctype="multipart/form-data" id="reserve_form">

                                    @csrf
                                    <input type="hidden" name="book_id" id="book_id" value="{{$book->id}}">
                                    <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">
                                    {{-- <input type="hidden" name="borrow_date" id="borrow_date" value="{{$book->reservation_date}}"> --}}

                                    <div class="form-group" id="datepicker">
                                        <label for="return_date">Return Date</label>
                                        <input type="text" class="form-control" name="return_date" id="datepicker">
                                        @error('return_date') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                      
                                    <button class="btn btn-primary" type="submit">Claim</button>
                                

                                </form>
                                @endif
                                   
                                <form action="{{route('cancel',$book->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">
                                    <button class="btn btn-danger mt-2" type="submit">Cancel</button>
                                </form>

                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <h3 class="text-center mt-3">No Reservation Yet</h3>
    @endforelse


@endsection
@section('scripts')
    <script>
        flatpickr("#datepicker", {});
        $('#reserve_form').on('submit', function() {
            setTimeout(function() {
        
                window.location.href = "{{URL::to('books')}}"

            }, 1000);

        });
    </script>
@endsection
