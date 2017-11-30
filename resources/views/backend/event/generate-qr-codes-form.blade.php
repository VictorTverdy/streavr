@extends('backend.template')

@section('title', 'Generate QR codes')

@section('page_level_plugins_css')
    <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_css')
@endsection

@section('page_level_plugins_js')
    <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
@endsection

@section('page_level_js')
    <script src="/assets/pages/scripts/generate-qr-codes.js" type="text/javascript"></script>
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
                <a href="{{ url('/events') }}">Events</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Generate QR codes</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Generate QR codes</h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">Generate QR codes for event "{{$event->name}}"</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="/event/generate-qr-codes" id="form_generate" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Distributor
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <select class="form-control" name="distributor_id">
                                        <option value="">Select...</option>
                                        @foreach($distributors as $distributor)
                                            <option value="{{$distributor->id}}">{{$distributor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Quantity
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="quantity" class="form-control" /> </div>
                                    <input type="hidden" name="event_id" class="form-control" value="{{$event->id}}"/> </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn blue-steel">Generate</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
@endsection
