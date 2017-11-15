@extends('backend.template')

@section('title', 'Edit Video')

@section('page_level_plugins_css')
    <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_css')
    <link href="/assets/pages/css/video-edit.css" rel="stylesheet" type="text/css" />
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
    <script src="/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
@endsection

@section('page_level_js')
    <script src="/assets/pages/scripts/video-edit.js" type="text/javascript"></script>
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
                <a href="{{ url('/videos') }}">Videos</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Edit Video</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Edit Video</h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold font-blue-steel uppercase">Video Info</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <form id="form_video_edit" action="/video/save" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $video->title }}" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="description" class="form-control" rows="5">{{ $video->description }}</textarea>
                                </div>
                                @if ($auth_user->user_level == 1)
                                    <div class="form-group">
                                        <label class="control-label">Category</label>
                                        <select class="form-control" name="category">
                                            <option value="">Select a category...</option>
                                            @foreach($categories as $category)
                                                @if ($category->id == $video->category_id)
                                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <input type="hidden" name="category" value="1">
                                @endif
                                <div class="form-group">
                                    <label class="control-label" style="display: block;">Video thumbnail</label>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="max-width: 250px;">
                                            <img src="{{ $video->thumbnail_url }}" alt="" /> </div>
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
                                    <label class="control-label">Visibility</label>
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="visibility" id="visibility_show" value="1" @if ($video->visibility) checked="" @endif /> Show
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="visibility" id="visibility_hidden" value="0" @if ($video->visibility == 0) checked="" @endif> Hidden
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" id="video_id" value="{{ $video->id }}" />
                            <input type="hidden" name="video_path" id="video_path" />
                            <input type="hidden" name="video_name" id="video_name" />
                            <input type="hidden" name="form_action" value="edit" />
                            <input type="hidden" name="video_size" id="video_size" value="{{ $video->video_size }}" />
                        </form>
                        <form id="form_video_upload" action="/video/upload" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">Video File</label>
                                    <div class="row fileupload-buttonbar">
                                        <div class="col-lg-7">
                                            <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn blue-steel fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span> Add video file </span>
                                            <input type="file" name="video"> </span>
                                            <!--button type="submit" class="btn blue start">
                                                <i class="fa fa-upload"></i>
                                                <span> Start upload </span>
                                            </button>
                                            <button type="reset" class="btn warning cancel">
                                                <i class="fa fa-ban-circle"></i>
                                                <span> Cancel upload </span>
                                            </button-->
                                            <!-- The global file processing state -->
                                            <span class="fileupload-process"> </span>
                                        </div>
                                    </div>
                                    <!-- The table listing the files available for upload/download -->
                                    <table role="presentation" class="table table-striped clearfix">
                                        <tbody class="files"> </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="form-actions">
                        <div class="margin-top-10">
                            <button type="submit" id="save_video_butt" class="btn blue-steel">Save Video</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- The blueimp Gallery widget -->
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
        <div class="slides"> </div>
        <h3 class="title"></h3>
        <a class="prev"> ‹ </a>
        <a class="next"> › </a>
        <a class="close white"> </a>
        <a class="play-pause"> </a>
        <ol class="indicator"> </ol>
    </div>
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger label label-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                <div class="progress-bar progress-bar-success-new" style="width:100%;"></div>
            </div>
        </td>
        <td> {% if (!i && !o.options.autoUpload) { %}
            <button class="btn blue start" disabled>
                <i class="fa fa-upload"></i>
                <span>Start</span>
            </button> {% } %} {% if (!i) { %}
            <button class="btn red cancel">
                <i class="fa fa-ban"></i>
                <span>Cancel</span>
            </button> {% } %} </td>
    </tr> {% } %} </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade" data-path="{%=file.path%}" data-name="{%=file.name%}" data-size="{%=file.size%}">
        <td>
            <p class="name"> {% if (file.url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl? 'data-gallery': ''%}>{%=file.name%}</a> {% } else { %}
                <span>{%=file.name%}</span> {% } %} </p> {% if (file.error) { %}
            <div>
                <span class="label label-danger">Error</span> {%=file.error%}</div> {% } %} </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td> {% if (file.deleteUrl) { %}
            <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                <i class="fa fa-trash-o"></i>
                <span>Delete</span>
            </button>
            {% } else { %}
            <button class="btn yellow cancel btn-sm">
                <i class="fa fa-ban"></i>
                <span>Cancel</span>
            </button> {% } %} </td>
    </tr> {% } %} </script>
@endsection
