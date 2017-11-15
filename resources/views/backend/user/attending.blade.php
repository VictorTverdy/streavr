@extends('backend.template')

@section('title', 'User attending')


@section('page_level_css')
<link href="/assets/pages/css/attending.css" rel="stylesheet" type="text/css" />
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
            <span>User attending</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">User info</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-3">
        <table class="table table-striped table-bordered table-hover" >
            <tbody>
                <tr>
                    <td><b>User Name:</b></td><td>{{$user->first_name}} {{$user->last_name}}</td>
                </tr>
                <tr>
                    <td><b>Email:</b></td><td>{{$user->email}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<a href="/users/" class=" btn btn-md blue">Back</a>
<h1 class="page-title">Events attending</h1>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover" >
            <thead>
            <tr role="row" class="heading">
                <th>No</th>
                <th>Time start</th>
                <th>Event name</th>
                <th>Registration Status</th>
                <th>Payment Method</th>
                <th>Payment status</th>
                <th>Payment source</th>
            </tr>
            </thead>
            <tbody>
            @if (count($attendees) === 0)
            <tr>
                <td colspan="7">Not found</td>
            </tr>
            @else
                @foreach ($attendees as $attendee)
                <tr>
                    <td>{{ $loop->iteration }} </td>
                    <td>{{ $attendee->event->time_start }}</td>
                    <td>{{ $attendee->event->name }}</td>
                    <td>{{ $attendee->registrationStatus->name }}</td>
                    <td>{{ $attendee->paymentMethod->name }}</td>
                    <td>{{ $attendee->paymentStatus->name }}</td>
                    <td>{{ $attendee->paymentSource->name }}</td>
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

