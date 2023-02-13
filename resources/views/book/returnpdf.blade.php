@include('_includes.returnpdfstyle')

<div class="container">
    <div class="brand-section">
        <div class="row">
            <div class="col-6">
                <h1 class="text-white">LMS</h1>
            </div>
            <div class="col-6">

            </div>
        </div>
    </div>

    <div class="body-section">
        <div class="row">
            <div class="col-6">
                @php
                     $invoice= mt_rand();
                 @endphp
                 <h2 class="heading">Invoice No. {{$invoice}}</h2>
                 <p class="sub-heading"><strong> Name: </strong>{{$userinfo->name}} </p>
                 <p class="sub-heading"><strong> Email: </strong>{{$userinfo->email}} </p>
   
            </div>

        </div>
    </div>

    <div class="body-section">
        <h3 class="heading">Return Details</h3>
        <br>
        <table class="table-bordered">
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th class="w-20">Quantity</th>
                    <th class="w-20">Return Date</th>
                    <th class="w-20">Sumbit Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $bookName->name }}</td>
                    <td>{{ $quantity}}</td>
                    <td>{{ \Carbon\Carbon::parse($book->return_date)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($submitDate)->format('Y-m-d') }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-center">Fine</td>
                    <td> {{ $fine ?? 0 }}</td>
                </tr>

            </tbody>
        </table>
        <br>
        @if ($book->return_date < $submitDate)
            <h3 class="heading">Return Status: Late Returned</h3>
        @else
             <h3 class="heading">Return Status: Early Returned</h3>
        @endif
     
        <h3 class="heading">Note: Late submission will fine 5rs. per day. Thank you </h3>
    </div>

</div>
