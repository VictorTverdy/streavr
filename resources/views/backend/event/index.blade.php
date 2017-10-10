
@extends('backend.template')

@section('title', 'All events')

@section('page_level_plugins_css')
    <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_plugins_js')
    <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
@endsection

@section('page_level_css')
    <link href="/assets/pages/css/event.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_js')
    <script src="/assets/pages/scripts/event.js" type="text/javascript"></script>
@endsection

@section('content')
    <!-- BEGIN PAGE HEADER-->
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ url('/') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>All events</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Events</h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <form id="form_video" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-hover" id="datatable_event">
                    <thead>
                    <tr role="row" class="heading">
                        <th>Thumbnail</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Time start</th>
                        <th>Time length</th>
                        <th>Created Date</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </form>
@endsection