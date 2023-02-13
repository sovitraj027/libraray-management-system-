@extends('layouts.app')
@section('content')
    <x-breadcrumb parentPageTitle="My books" parentPageUrl="{{ route('return') }}" currentPageTitle="mybooks">
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
                                <h4 class=""><strong>Name:</strong> {{ $book->name }}</h4><br>
                                <h4 class=""><strong>Category:</strong> {{ $book->category->name }}</h4><br>
                                <h4 class=""><strong>Publisher:</strong> {{ $book->publisher }}</h4><br>
                                <h4 class=""><strong>Taken Quantity:</strong> {{ $book->taken_quantity ?? 0 }}
                                </h4><br>
                                <h4 class=""><strong>Return Date:</strong> {{\Carbon\Carbon::parse( $book->return_date ?? 0 )->format('Y-m-d')}}</h4>
                                <br>
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
