@extends('backend.template')

@section('title', 'Email Template')

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
    <script src="/assets/pages/scripts/email-template.js" type="text/javascript"></script>
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
                <span>Settings</span>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Email Template</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Email Template</h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">Email Template Info</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="/settings/email-template/save" id="form_template" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-1">From (email)
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="email_from" class="form-control" value="{{ $template->from_email }}" /> </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-1">From (name)
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="name_from" class="form-control" value="{{ $template->from_name }}" /> </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-1">Subject
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="subject" class="form-control" value="{{ $template->subject }}" /> </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-1">Body
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <textarea name="body" class="form-control">{{ $template->body }} </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn blue-steel">Submit</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="id" value="{{ $template->id }}" />
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
@endsection
