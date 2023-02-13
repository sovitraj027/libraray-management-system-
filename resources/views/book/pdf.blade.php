

 @include('_includes._pdfstyle')

 <div class="container">
     <div class="brand-section">
         <div class="row">
             <div class="col-6">
                 <h1 class="text-white">LMS</h1>
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
         <h3 class="heading">Borrow Details</h3>
         <br>
         <table class="table-bordered">
             <thead>
                 <tr>
                     <th>Book Name</th>
                     <th class="w-20">Quantity</th>
                     <th class="w-30">Borrow Date</th>
                     <th class="w-30">Return Date</th>
                 </tr>
             </thead>
             <tbody>
                 <tr>
                    <td>{{$bookName->name}}</td>
                    <td>{{$book->quantity}}</td>
                     <td>{{\Carbon\Carbon::parse($book->borrow_date)->format('Y-m-d')}}</</td> 
                    <td>{{\Carbon\Carbon::parse($book->return_date)->format('Y-m-d')}}</td> 
                 </tr>       
             </tbody>
         </table>
         <br>
         <h3 class="heading"><strong>Note: Late submission will fine 5rs. per day. Thank you</strong>  </h3>
     </div>
 
 </div> 


 
 
 
 
         
 
 
