@extends('layouts.app')

@section('content')

    <x-breadcrumb parentPageTitle="All Book" parentPageUrl="{{ route('books.index') }}" currentPageTitle="Borrow Book">
    </x-breadcrumb>

    <div class="card">

        <div class="card-body">

            <form action="{{ route('save') }}" method="POST" enctype="multipart/form-data" id="borrow_form">

                @csrf
                <input type="hidden" name="book_id" id="book_id" value="{{ $id }}">

                <input type="hidden" name="librarian_id" id="librarain_id" value="{{ auth()->user()->id }}">

                <div class="form-group">
                    <label for="user_id">Members Name</label>
                    <select class="form-control" name="user_id" id="user_id">
                        <option value="" selected disabled>Select Member</option>
                        @foreach ($members as $key => $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                        @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </select>
                </div>

                <div class="form-group" id="datepicker">
                    <label for="borrow_date">Borrow Date</label>
                    <input type="text" class="form-control" name="borrow_date" id="datepicker"
                        value="{{ old('borrow_date') }}">
                    @error('borrow_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" id="datepicker">
                    <label for="return_date">Return Date</label>
                    <input type="text" class="form-control" name="return_date" id="datepicker"
                        value="{{ old('return_date') }}">
                    @error('return_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="return_date">Quantity</label>
                    <select class="form-control mb-2" name="quantity" id="quantity">
                        <option value="1" selected>1</option>
                    </select>
                    @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button class="btn btn-primary" type="submit">Issue</button>
            </form>

        </div>
    </div>

@endsection
@section('scripts')
    <script>
        flatpickr("#datepicker", {});
        $('#user_id').select2();

        $('#borrow_form').on('submit', function() {
            setTimeout(function() {
          
                window.location.href = "{{URL::to('books')}}"

            }, 1000);

        });
    </script>
@endsection
