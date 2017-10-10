@include('backend.layouts.header')

@include('backend.layouts.sidebar_menu')

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        @yield('content')
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

@include('backend.layouts.footer')