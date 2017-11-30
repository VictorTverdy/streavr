
@extends('backend.template')

@section('title', 'QR Codes')

@section('page_level_plugins_css')
    <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_plugins_js')
    <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
@endsection

@section('page_level_css')
    <link href="/assets/pages/css/event.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_js')
    <script src="/assets/pages/scripts/event.js" type="text/javascript"></script>
@endsection

@section('content')
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
                <span>QR codes</span>
            </li>
        </ul>
    </div>

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">QR codes for event "{{$event->name}}"</h1>
    <!-- END PAGE TITLE-->

    <table class="table table-striped table-bordered table-hover dataTable no-footer">
    <thead>
        <tr class="heading">
            <th>QR Code</th>
            <th>Payment Source</th>
            <th>Used</th>
        </tr>
    </thead>
    @foreach($codes as $qrCode)
      <tr>
          <td>
              <?php
              echo '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG($qrCode->qr_code, "QRCODE",4,4) . '" alt="barcode"   />';
              ?>
          </td>
          <td>
              {{$qrCode->paymentSource->name}}
          </td>
          <td>
              {{($qrCode->is_used==0) ? 'no' : 'yes'}}
          </td>
      </tr>

    @endforeach
</table>
@endsection