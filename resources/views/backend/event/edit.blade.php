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
    <script src="/assets/pages/scripts/event-new.js" type="text/javascript"></script>
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
                <span>Edit Event</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Edit Event</h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold font-blue-steel uppercase">Event Info</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form id="form_event_edit" action="/event/save" method="post" enctype="multipart/form-data">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $event->name }}" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $event->title }}" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Subtitle</label>
                                    <input type="text" name="subtitle" class="form-control" value="{{ $event->subtitle }}" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="description" class="form-control" rows="5">{{ $event->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Price</label>
                                    <input type="text" name="price" id="price" class="form-control" value="{{ $event->price }}" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Date and Time start</label>
                                    <input type="text" name="time_start" id="time_start" class="form-control" value="{{ $event->time_start }}" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Length (hr)</label>
                                    <input type="text" name="time_length" id="time_length" class="form-control" value="{{ $event->time_length }}" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label" style="display: block;">Event thumbnail</label>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="max-width: 250px;">
                                            <img src="{{ $event->thumbnail_url }}" alt="" /> </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px;"> </div>
                                        <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> Select image </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="thumbnail" />
                                        </span>
                                            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" style="display: block;">Event background</label>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="max-width: 250px;">
                                            <img src="{{ $event->background_img_url }}" alt="" /> </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px;"> </div>
                                        <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> Select image </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="background_img" />
                                        </span>
                                            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="margin-top-10">
                                <input type="hidden" name="id" id="event_id" value="{{ $event->id }}" />
                                <button type="submit" id="save_event_butt" class="btn blue-steel">Save Event</button>
                            </div>
                        </div>
                        <input type="hidden" name="form_action" value="edit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
