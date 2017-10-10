@extends('backend.template')

@section('title', 'Dashboard')

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
            <span>Dashboard</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> Dashboard </h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="note note-info">
    <p> This is dashboard. </p>
</div>
@endsection
