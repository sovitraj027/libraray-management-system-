@extends('layouts.app')

@include('_includes._datatable_css')

@section('content')

   <x-breadcrumb currentPageTitle="All Category"></x-breadcrumb>

   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-sm-right">
                        <a href="{{route('categories.create')}}" type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2">
                            <i class="bx bx-user-plus mr-1"></i>
                            Add Category
                        </a>
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th width="5%">S.No.</th>
                            <th>Name</th>                        
                        <th>Slug</th>                        
                        <th width="15%">Action</th>
                        </tr>
                        </thead>

                        <tbody id="tablecontents">
                         @forelse ($categories as $category)

                            <tr class="row1" data-id="{{ $category->id }}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$category->name}}</td>
                        
                        <td>{{$category->slug}}</td>
                        
                        <td>
                                    <div class="float-right d-flex">
                                       <a href="{{route('categories.edit', $category->id) }}" class="btn btn-outline-primary btn-sm edit mr-2" title="Edit">
                                            <i class="fas fa-pencil-alt" title="Edit"></i>
                                       </a>

                                       <form action="{{route('categories.destroy', $category->id ) }}" method="POST">
                                             @csrf
                                              @method('DELETE')
                                              <button onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="btn btn-outline-danger btn-sm" type="submit" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                              </button>
                                       </form>

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

@include('_includes._datatable_js')
