@extends('backend.template')

@section('title', 'All video categories')

@section('page_level_plugins_css')
<link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_plugins_js')
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
@endsection

@section('page_level_css')
    <link href="/assets/pages/css/video-category.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_js')
<script src="/assets/pages/scripts/video-category.js" type="text/javascript"></script>
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
            <a href="{{ url('/videos') }}">Video</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Categories</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Video Categories</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-4">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold font-blue-steel uppercase">Add New Category</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="form_video_category" action="/video/category/save" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" name="name" class="form-control" />
                    </div>
                    <!--div class="form-group">
                        <label class="control-label">Slug</label>
                        <input type="text" name="slug" class="form-control" />
                    </div-->
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <textarea name="description" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label" style="display: block;">Thumbnail</label>
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="" alt="" /> </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
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
                    <div class="form-actions">
                        <div class="margin-top-10">
                            <button type="submit" class="btn blue-steel">Add New Category</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
            <table class="table table-striped table-bordered table-hover" id="datatable_category">
                <thead>
                <tr role="row" class="heading">
                    <th>Thumbnail</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
    </div>
</div>
@endsection
