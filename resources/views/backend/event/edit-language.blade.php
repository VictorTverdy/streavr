@extends('backend.template')

@section('title', 'New Event')

@section('page_level_plugins_css')
    <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_css')
    <link href="/assets/pages/css/event-new.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_plugins_js')
    <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>

    <script src="/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script src="/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>

@endsection

@section('page_level_js')
    <script src="/assets/pages/scripts/event-language.js" type="text/javascript"></script>
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
                <a href="{{ url('/events') }}">Events</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Edit Event language Version</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Edit Event language Version</h1>
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
                    <form id="form_event_edit" action="/event/language/save" method="post" enctype="multipart/form-data">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="@if (!is_null($eventLanguage)) {{ $eventLanguage->name }} @endif" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" name="title" class="form-control" value="@if (!is_null($eventLanguage)) {{ $eventLanguage->title }} @endif" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Subtitle</label>
                                    <input type="text" name="subtitle" class="form-control" value="@if (!is_null($eventLanguage)) {{ $eventLanguage->subtitle }} @endif" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="description" class="form-control" rows="5">@if (!is_null($eventLanguage)) {{ $eventLanguage->description }} @endif</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <div class="form-control">{{ $event->name }}</div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <div class="form-control">{{ $event->title }}</div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Subtitle</label>
                                    <div class="form-control"> {{ $event->subtitle }} </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <div class="form-control"> {{ $event->description }} </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="margin-top-10">
                                <input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}" />
                                <input type="hidden" name="language_id" id="language_id" value="{{$language->id }}" />
                                <input type="hidden" name="id" id="event_language_id" value="@if (!is_null($eventLanguage)) {{ $eventLanguage->id }} @endif" />
                                <button type="submit" id="save_event_language_butt" class="btn blue-steel">Save Language Version</button>
                            </div>
                        </div>
                        <input type="hidden" name="form_action" value="edit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
