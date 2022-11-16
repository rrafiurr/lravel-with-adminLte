@extends('layout.layout')
@section('content')

<div class="row">
    <div class="col-12">
    <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Member</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                    <th>Payment Media</th>
                    <th>Payment Details</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($transactions as $r)
                  <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->user->name }} <br> {{ $r->user->phone_no }}</td>
                    <td>{{ $r->amount }}</td>
                    <td>{{ $r->date }}</td>
                    <td>{{ $r->transaction_medias->name }}</td>
                    <td>{{ $r->proof }}</td>
                    <td>X</td>
                  </tr>
                  @endforeach
                  
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
    </div>
</div>


@push('scripts')

<!-- DataTables  & Plugins -->
<script src="{{ custom_asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ custom_asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ custom_asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "order": [[0, 'desc']]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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