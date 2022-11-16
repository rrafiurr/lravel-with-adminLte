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
                    <th>SL #</th>
                    <th>Name</th>
                    <th>Total Paid</th>
                    <th>Due</th>
                    <th>Advance</th>
                    <th>Last Payment</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($users as $r)
                  <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->name }} <br> {{ $r->phone_no }} <br> {{ $r->email }}</td>
                    <td>{{ $data[$r->id] }}</td>
                    <td>
                      <?php 
                        if($total_amount > $data[$r->id]) 
                        { 
                          echo $total_amount - $data[$r->id]; 
                        } 
                        else 
                        { 
                          echo "0"; 
                        } 
                        ?>
                      </td>
                    <td>
                      <?php 
                          if($total_amount < $data[$r->id]) 
                          { 
                            echo $data[$r->id] - $total_amount; 
                          } 
                          else 
                          { 
                            echo "0"; 
                          } 
                      ?>
                    </td>
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
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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