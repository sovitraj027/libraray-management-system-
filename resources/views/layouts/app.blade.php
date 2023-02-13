<!doctype html>
<html lang="en">

<head>
    <title>LMS</title>
    @include('_includes._common_head')

</head>

<body data-sidebar="dark">

<!-- Loader -->
@include('_includes._preload')

<!-- Begin page -->
<div id="layout-wrapper">

@include('_includes._header')

<!-- ========== Left Sidebar Start ========== -->
@include('_includes._left_sidebar')
<!-- ========== Left Sidebar End ========== -->

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                @yield('content')

            </div>
        </div>
    </div>
    <!-- ========== Footer Start ========== -->
@include('_includes._footer')
<!-- ========== Footer Ends ========== -->

</div>
<!-- END layout-wrapper -->

<!-- ========== Right Sidebar Start ========== -->
{{--@include('_includes._right_sidebar')--}}
<!-- ========== Right Sidebar Ends ========== -->

<!-- JAVASCRIPT -->
<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>


<script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>

<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{ asset('js/toastr.js') }}"></script>
<script>
    @if (Session::has('success'))
    toastr.success("{{Session::get('success')}}")
    @endif

    @if (Session::has('error'))
    toastr.error("{{Session::get('error')}}")
    @endif

    @if (Session::has('info'))
    toastr.info("{{Session::get('info')}}")
    @endif
</script>
{{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@stack('inlinejs')
@yield('scripts')
@yield('custom_js')
</body>

</html>
