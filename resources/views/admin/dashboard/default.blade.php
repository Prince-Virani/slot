@extends('layouts.admin.master')

@section('title', 'Default Page')

@push('breadcrumb')
<li class="breadcrumb-item">Pages</li>
<li class="breadcrumb-item active">Sample Page</li>
@endpush

@push('css')
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/animate.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/chartist.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/date-picker.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/prism.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vector-map.css')}}">
@endpush
    @section('content')
      @yield('breadcrumb-list')
      <!-- Container-fluid starts-->

      <!-- Container-fluid Ends-->
    @push('scripts')
      <script src="{{asset('admin/assets/js/chart/chartist/chartist.js')}}"></script>
      <script src="{{asset('admin/assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
      <script src="{{asset('admin/assets/js/chart/knob/knob.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/chart/knob/knob-chart.js')}}"></script>
      <script src="{{asset('admin/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
      <script src="{{asset('admin/assets/js/chart/apex-chart/stock-prices.js')}}"></script>
      <script src="{{asset('admin/assets/js/prism/prism.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/clipboard/clipboard.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/counter/jquery.waypoints.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/counter/jquery.counterup.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/counter/counter-custom.js')}}"></script>
      <script src="{{asset('admin/assets/js/custom-card/custom-card.js')}}"></script>
      <script src="{{asset('admin/assets/js/notify/bootstrap-notify.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/vector-map/jquery-jvectormap-2.0.2.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js')}}"></script>
      <script src="{{asset('admin/assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js')}}"></script>
      <script src="{{asset('admin/assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js')}}"></script>
      <script src="{{asset('admin/assets/js/vector-map/map/jquery-jvectormap-au-mill.js')}}"></script>
      <script src="{{asset('admin/assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js')}}"></script>
      <script src="{{asset('admin/assets/js/vector-map/map/jquery-jvectormap-in-mill.js')}}"></script>
      <script src="{{asset('admin/assets/js/vector-map/map/jquery-jvectormap-asia-mill.js')}}"></script>
      <script src="{{asset('admin/assets/js/dashboard/default.js')}}"></script>
      <script src="{{asset('admin/assets/js/notify/index.js')}}"></script>
      <script src="{{asset('admin/assets/js/datepicker/date-picker/datepicker.js')}}"></script>
      <script src="{{asset('admin/assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
      <script src="{{asset('admin/assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
    @endpush
@endsection
