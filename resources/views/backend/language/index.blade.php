
@extends('backend.template')

@section('title', 'Languages')

@section('page_level_css')
    <link href="/assets/pages/css/language.css" rel="stylesheet" type="text/css" />
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
                <span>Languages</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Languages</h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <form id="form_method" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-hover" id="datatable_event">
                    <thead>
                    <tr role="row" class="heading">
                        <th width="5%"></th>
                        <th width="5%">Key</th>
                        <th width="5%">Default</th>
                        <th>Name</th>
                        <th width="5%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($languages as $language)
                        <tr>
                            <td><img class="thumbnail" src="{{$language->thumbnail_url}}"></td>
                            <td>{{$language->id}}</td>
                            <td>@if ($language->is_default ==1 )
                                    yes
                                @endif
                            </td>
                            <td>{{$language->name}}</td>
                            <td><a href="/settings/language/edit/{{$language->id}}" class="btn btn-xs blue edit-butt"><i class="fa fa-edit"></i> Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
@endsection