@extends('layouts.app')

@section('content')
{{-- <form action="">

        <div class="form-group">
      
            <input type="file" class="form-control" name="book_image" id="image" alt="image">
            @error("image") <span class="text-danger">{{$message}}</span> @enderror
        </div>
   
    <button class="btn btn-primary" type="submit">Store</button>

</form> --}}
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    Import file
                </div>
                <div class="card-body">
                    <form action="{{route('file-import')}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Choose Csv</label>
                            <input type="file" name="file" class="form-control">   
                        </div>
                       
                        <button type="submit" class="btn btn-sm btn-success">submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection