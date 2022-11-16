@extends('layout.layout')
@section('content')

<div class="col-md-6">
Dashboard
</div>


@push('scripts')
<!-- Select2 -->
<link rel="stylesheet" href="{{ custom_asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ custom_asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<script src="{{ custom_asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()


    </script>
@endpush

@endsection