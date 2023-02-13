@extends('layouts.app')
@include('_includes._datatable_css')
@if(auth()->user()->user_type_id==1||auth()->user()->user_type_id==2)
@section('content')
    <x-breadcrumb currentPageTitle="All Book"></x-breadcrumb>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-sm-right">
                        @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
                            <a href="{{ route('books.create') }}" type="button"
                               class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2">
                                <i class="bx bx-user-plus mr-1"></i>
                                Add Book
                            </a>
                        @endif
                    </div>
                    <div class="text-sm-right">
                        @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
                            <a href="{{route('import')}}" type="button"
                               class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2">
                                Import Excel
                            </a>
                        @endif
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th width="5%">S.No.</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Publisher</th>
                            <th>Published_at</th>
                            <th>Quantity</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>
                        <tbody id="tablecontents">
                        @forelse ($books as $book)
                            @if ($book->quantity!==0)
                            <tr class="row1" data-id="{{ $book->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $book->name }}</td>
                                <td><img src="/storage/book-image/{{ $book->image }}" width="100" height="50"></td>
                                <td>{{ $book->publisher_name}}</td>
                                <td>{{ $book->published_at }}</td>
                                <td>{{ $book->quantity }}</td>
                                <td>
                                    <a href="{{ route('books.show', $book->id) }}" type="button"
                                       class=" btn btn-sm btn btn-outline-primary mb-2 mr-2">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    @if (auth()->user()->user_type_id==3)
                                    <a href="{{ route('bookreservation', $book->id) }}" type="button"
                                        class=" btn btn-sm btn btn-outline-primary mb-2 mr-2">
                                         {{-- <i class="fa fa-ticket" aria-hidden="true"></i> --}}
                                         <i class="fas fa-plus-square"></i>
                                     </a>
                                    @endif
                                    <div class="float-right d-flex">
                                        @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)

                                            <a href="{{ route('books.edit', $book->id) }}"
                                               class="btn btn-outline-primary btn-sm edit mr-2" title="Edit">
                                                <i class="fas fa-pencil-alt" title="Edit"></i>
                                            </a>

                                            <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                        onclick="return confirm('Are you sure you want to delete this item?');"
                                                        class="btn btn-outline-danger btn-sm" type="submit" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td>No record</td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
@else
@section( 'content')
@include('book.style.booklisting')
@if($book->isNotEmpty())
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
                {!! Str::limit($book->description, 50) !!} <a href="{{ route('books.show', $book->id) }}">View Detail</a>
            </p>
            <p>
                <a href="{{ route('bookreservation', $book->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-square"></i> Reserve this</a>
            </p>
            <div class="user">
                <img src="https://cdn.pixabay.com/photo/2013/07/13/10/07/man-156584_960_720.png"
                    alt="user" />
                <div class="user-info">
                    <h5>{{$book->author_name}}</h5>
                    <small>Published At:{{$book->published_at}}</small>
                </div>
            </div>
        </div>
    </div>  
    @endforeach
   
</div>
@endif
@endsection
@endif
@include('_includes._datatable_js')
