@extends('layouts.app')

@section('content')

<x-breadcrumb parentPageTitle="Issue Book" parentPageUrl="" currentPageTitle="issue book">
</x-breadcrumb>
<style>
    .error {
        user: red;
        border-user: red;
    }
</style>
<div class="card">

    <div class="card-body">
        <form action="" id="" method="POST" enctype="multipart/form-data" id="Myform">
            @csrf
            <div class="row">
                <div class="form-group col-6">
                    <label for="name">Student Name</label>
                   <select class="form-control selectform" name="user_id" id="user_id" required>
                        @foreach ($users as $key=>$user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    @error("name") <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="form-group col-6">
                    <label for="name">Return Date</label>
                    <input type="text" class="form-control" name="name" id="datepicker" value="{{old('name')}}">
                    @error("name") <span class="text-danger">{{$message}}</span> @enderror
                </div>
                
            </div>
            <div class="container">
                <br><br>
                <h3>Add Book</h3>
                <span id="message_error"></span>
                <hr><br>
                <table id="emptbl" class="table table-bordered border-primar">

                    <tbody>
                        <tr>
                            <td id="col0" class="col-4"><input type="number" class="form-control " name="quantity[]"
                                    placeholder="Enter piece" required></td>
                            <td id="col1" class="col-4">
                                <select class="form-control selectform" name="user[]" id="user" required>
                                    {{-- @foreach ($colors as $key=>$user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach --}}
                                </select>
                            </td>
                            <td id="col2" class="col-4">
                                <select class="form-control selectform" name="size[]" id="size" required>
                                    {{-- @foreach ($sizes as $key=>$size)
                                    <option value="{{$size->id}}">{{$size->title}}</option>
                                    @endforeach --}}
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="container">
                    <div class="row">
                        <div class="form-group col-3">
                            <input type="number" class="form-control " name="price" placeholder="Enter price" required>
                        </div>
                        <div class="form-group col-6 float-right">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="custom" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">cutomizable</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="custom" id="inlineRadio2" value="0">
                                <label class="form-check-label" for="inlineRadio2">Non-Customizable</label>
                            </div>
                        </div>
                    </div>

                </div>
                <table>
                    <br>
                    <tr>
                        <td><button type="button" class="btn btn-sm btn-info" onclick="addRows()">Add</button></td>
                        <td><button type="button" class="btn btn-sm btn-danger" onclick="deleteRows()">Remove</button>
                        </td>
                        <button class="btn btn-success btn-l float-right" type="submit">Create Product</button>

                    </tr>
                </table>


        </form>
    </div>
</div>
</div>
@endsection
@push('inlinejs')
@section('scripts')
<script>
  $('#user_id').select2();
    flatpickr("#datepicker", {});

</script>

<script>
    function addRows() {
        var table = document.getElementById('emptbl');
        var rowCount = table.rows.length;
        var cellCount = table.rows[0].cells.length;
        var row = table.insertRow(rowCount);
        for (var i = 0; i <= cellCount; i++) {
            var cell = 'cell' + i;
            cell = row.insertCell(i);
            var copycel = document.getElementById('col' + i).innerHTML;
            cell.innerHTML = copycel;
            if (i == 3) {
                var radioinput = document.getElementById('col2').getElementsByTagName('input');
                for (var j = 0; j <= radioinput.length; j++) {
                    if (radioinput[j].type == 'radio') {
                        var rownum = rowCount;
                        radioinput[j].name = 'gender[' + rownum + ']';
                    }
                }
            }
        }
    }

    function deleteRows() {
        var table = document.getElementById('emptbl');
        var rowCount = table.rows.length;
        if (rowCount > '1') {
            var row = table.deleteRow(rowCount - 1);
            rowCount--;
        } else {
            alert('There should be atleast one row');
        }
    }

</script>
<!-- alert blink text -->
<script>
    function blink_text() {
        $('#message_error').fadeOut(700);
        $('#message_error').fadeIn(700);
    }
    setInterval(blink_text, 1000);

</script>
<!-- script validate form -->
<script>
    $('#validate').validate({
        reles: {
            , 'quantity[]': {
                required: true
            , }
            , 'size[]': {
                required: true
            , }
            , 'user[]': {
                required: true
            , }
        , }
        , messages: {
            , 'quantity[]': "Please input file*"
            , 'user[]': "Please input file*"
            , 'size[]': "Please input file*"
        , }
    , });

</script>
@endsection

<script>
    window.onload = function() {

        // to display image preview
        let siteImage = document.getElementById('image');
        let showImagePreview = document.getElementById('showImagePreview');
        showImagePreview.style.display = "none";

        siteImage.onchange = evt => {
            const [file] = siteImage.files
            if (file) {
                showImagePreview.style.display = "block";
                showImagePreview.src = URL.createObjectURL(file);
                showImagePreview.onload = function() {
                    URL.revokeObjectURL(showImagePreview.src) // free memory
                }
            }
        }
    };

</script>
@endpush