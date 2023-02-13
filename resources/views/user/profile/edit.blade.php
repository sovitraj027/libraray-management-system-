{{-- @extends('layouts.app')

@section('content')
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-10">
            <h1>User name</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <!--left col-->
            <div class="text-center">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                <h6>Upload a different photo...</h6>
                <input type="file" class="text-center center-block file-upload">
            </div>
            </hr><br>
        </div>
        <!--/col-3-->
        <div class="col-sm-9">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                    <form class="form" action="" method="post" id="">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name">
                                    <h4>Name</h4>
                                </label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="first name" title="enter your first name if any.">
                            </div>
                        </div>
                         <div class="form-group">
                             <div class="col-xs-6">
                                 <label for="email">
                                     <h4>Email</h4>
                                 </label>
                                 <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
                             </div>
                         </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="phone">
                                    <h4>Phone</h4>
                                </label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any.">
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>  
            </div>
        </div>
        <div class="col-sm-12">
           <div class="row col-12">
                 <div class="form-group">
                     <div class="col-6">
                         <label for="location">
                             <h4>Location</h4>
                         </label>
                         <input type="text" class="form-control" id="location" placeholder="somewhere" title="enter a location">
                     </div>
                 </div>
                 <div class="form-group">
                     <div class="col-6">
                         <label for="education">
                             <h4>Education</h4>
                         </label>
                         <input type="text" class="form-control" name="education" id="education" placeholder="enter education" title="enter education.">
                     </div>
                 </div>
                 </div>

            
                   <div class="form-group">
                       <div class="col-xs-6">
                           <label for="facebook_link">
                               <h4>Facebook Link</h4>
                           </label>
                           <input type="text" class="form-control" name="facebook_link" id="facebook_link" placeholder="enter facebook_link number" title="enter your facebook_link number if any.">
                       </div>
                   </div>
                   <div class="form-group">
                       <div class="col-xs-6">
                           <label for="instagram_link">
                               <h4>Instagram Link</h4>
                           </label>
                           <input type="text" class="form-control" name="instagram_link" id="instagram_link" placeholder="enter instagram_link number" title="enter your instagram_link number if any.">
                       </div>
                   </div>
                   <div class="form-group">
                       <div class="col-xs-6">
                           <label for="linkedin_link">
                               <h4>LinkedIn Link</h4>
                           </label>
                           <input type="text" class="form-control" name="linkedin_link" id="linkedin_link" placeholder="enter linkedin_link number" title="enter your instagram_link number if any.">
                       </div>
                   </div>
                  
                   <div class="form-group">
                       <div class="col-xs-6">
                           <label for="password">
                               <h4>New Password</h4>
                           </label>
                           <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password" title="enter your  password.">
                       </div>
                   </div>
                   <div class="form-group">
                       <div class="col-xs-12">
                           <br>
                           <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                           <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                       </div>
                   </div>
        </div>
    </div>
    <!--/col-9-->
</div>
@endsection
<!--/row-->
<script>
    $(document).ready(function() {


    var readURL = function(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('.avatar').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
    }


    $(".file-upload").on('change', function(){
    readURL(this);
    });
    });

</script> --}}