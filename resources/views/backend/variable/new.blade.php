@extends('backend.template')

@section('title', 'New Variable')


@section('page_level_css')
    <link href="/assets/pages/css/event-new.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_plugins_js')
    <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
@endsection

@section('page_level_js')
    <script src="/assets/pages/scripts/variable-new.js" type="text/javascript"></script>
@endsection

<?php
$auth_user = \Illuminate\Support\Facades\Auth::user();
?>

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
                <a href="{{ url('/settings/variables') }}">Variables</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>New Variable</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Add New Variable</h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold font-blue-steel uppercase">Variable Info</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form id="form_variable" action="/settings/variable/save" method="post" enctype="multipart/form-data">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="name" class="form-control"  />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="description" class="form-control" rows="5"></textarea>
                                </div>

                            </div>
                            <input type="hidden" name="form_action" value="add" />
                        </div>
                        <div class="row">
                            <div class="form-actions">
                                <div class="col-md-4">
                                    <div class="margin-top-10">
                                        <button type="submit" id="save_variable_butt" class="btn blue-steel">Save Variable</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
