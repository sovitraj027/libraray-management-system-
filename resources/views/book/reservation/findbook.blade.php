@extends('layouts.app')

@section('content')

    <x-breadcrumb parentPageTitle="All Book" parentPageUrl="{{ route('books.index') }}" currentPageTitle="Return books">
        --}}
    </x-breadcrumb>

    <div class="card">

        <div class="card-body">

            <form action="{{ route('userbook') }}" method="POST" enctype="multipart/form-data">

                @csrf
                <div class="form-group">
                    <label for="user_id">Members Name</label>
                    <select class="form-control mb-2" name="user_id" id="user_id">
                        <option value="" disabled selected>Select member</option>
                        @foreach ($users as $key => $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="">
                    <button class="btn btn-primary ">Find Book</button>
                    <i class="bi bi-search"></i>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#user_id').select2();
    </script>
@endsection
