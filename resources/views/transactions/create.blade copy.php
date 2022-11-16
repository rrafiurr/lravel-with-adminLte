@extends('layout.layout')
@section('content')
<div id="app">
        <transaction-component></transaction-component>
    </div>


@push('scripts')
@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- DataTables  & Plugins -->
<script src="{{ custom_asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ custom_asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ custom_asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script>
  $(function () {
    $("#example2").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush

@endsection