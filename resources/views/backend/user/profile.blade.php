@extends('backend.template')

@section('title', 'Edit User')

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
    <script src="/assets/pages/scripts/user-profile.js" type="text/javascript"></script>
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
                <a href="{{ url('/user') }}">User</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>My Profile</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">My Profile</h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">Info</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="/user/save" id="form_user_edit" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">First Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" /> </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" /> </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Email
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input name="email" type="email" class="form-control" value="{{ $user->email }}" />
                                </div>
                            </div>
                            <!--div class="form-group">
                                <label class="control-label col-md-3">Username
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input name="username" type="text" class="form-control" value="{{ $user->username }}" />
                                </div>
                            </div-->
                            <div class="form-group">
                                <label class="control-label col-md-3">Password
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input name="password" id="password" type="password" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Re-type Password
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input name="password_confirm" type="password" class="form-control" /> </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Role
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <select class="form-control" name="role">
                                        <option value="">Select...</option>
                                        <option value="1" @if ($user->user_level == 1) selected @endif>Administrator</option>
                                        <option value="2" @if ($user->user_level == 2) selected @endif>User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="display: none">
                                <label class="control-label col-md-3">Enable
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="enable" id="enable_1" value="1" @if ($user->enable) checked="" @endif /> Yes
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="enable" id="enable_2" value="0" @if ($user->enable == 0) checked="" @endif> No
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--div class="form-group">
                                <label class="control-label col-md-3">Avatar</label>
                                <div class="col-md-4">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="" alt="" /> </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                        <div>
                                            <span class="btn default btn-file">
                                                <span class="fileinput-new"> Select image </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="avatar" />
                                            </span>
                                            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                            </div-->
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn blue-steel">Submit</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="user_id" value="{{ $user->id }}" />
                        <input type="hidden" name="profile" id="profile" value="1" />
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
@endsection
