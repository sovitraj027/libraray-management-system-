@extends('layouts.app')

@include('_includes._datatable_css')

@section('content')

    <x-breadcrumb currentPageTitle="All Users"></x-breadcrumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-sm-right">
                        @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
                            <a href="{{ route('users.create') }}" type="button"
                                class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2">
                                <i class="bx bx-user-plus mr-1"></i>
                                Add User
                            </a>
                        @endif
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th width="5%">S.No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
                                    <th width="15%">Action</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody id="tablecontents">
                            @forelse ($users as $user)

                                <tr class="row1" data-id="{{ $user->id }}">

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    @if ($user->user_type_id == 1)
                                        <td>Admin</td>
                                    @elseif($user->user_type_id == 2)
                                        <td>Librarian</td>
                                    @else
                                        <td>Member</td>
                                    @endif

                                    @if (auth()->user()->user_type_id == 1 || auth()->user()->user_type_id == 2)
                                       
                                        <td>
                                            <div class="float-right d-flex">
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-outline-primary btn-sm edit mr-2" title="Edit">
                                                    <i class="fas fa-pencil-alt" title="Edit"></i>
                                                </a>

                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        onclick="return confirm('Are you sure you want to delete this item?');"
                                                        class="btn btn-outline-danger btn-sm" type="submit" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    @endif
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

@include('_includes._datatable_js')
