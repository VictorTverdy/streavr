@extends('backend.template')

@section('title', 'Video Language')

@section('page_level_plugins_css')
    <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_plugins_js')
    <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>

@endsection

@section('page_level_js')
    <script src="/assets/pages/scripts/variable-language.js" type="text/javascript"></script>
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
                <span>Edit Variable language Version</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Edit Variable language Version</h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="caption">
                                <span class="caption-subject bold font-blue-steel uppercase">Language: {{$language->name}}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="caption">
                                <span class="caption-subject bold font-blue-steel uppercase">Language: English</span>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form id="form_variable" action="/settings/variable/language/save" method="post" enctype="multipart/form-data">
                            <div class="row">
                                {{ csrf_field() }}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <textarea name="description" class="form-control" rows="5">@if (!is_null($variableLanguage)) {{ $variableLanguage->description }} @endif</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <div class="form-control"> {{ $variable->description }} </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="margin-top-10">
                                    <input type="hidden" name="variable_id" id="variable_id" value="{{ $variable->id }}" />
                                    <input type="hidden" name="language_id" id="language_id" value="{{$language->id }}" />
                                    <input type="hidden" name="id" id="variable_language_id" value="@if (!is_null($variableLanguage)) {{ $variableLanguage->id }} @endif" />
                                    <button type="submit" id="save_variable_language_butt" class="btn blue-steel">Save Language Version</button>
                                </div>
                            </div>
                            <input type="hidden" name="form_action" value="edit" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
