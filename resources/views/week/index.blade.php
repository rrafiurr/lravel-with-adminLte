@extends('layout.layout')
@section('content')

@push('top_css')
<!-- fullCalendar -->
<link rel="stylesheet" href="{{ custom_asset('plugins/fullcalendar/main.css') }}">
@endpush
<div class="row">
    <div class="col-12">
    <div class="card">
              <!-- /.card-header -->
              <div class="card-body p-0">
              <form method="get" action="">
              <select class="form-control select2" style="width: 60%;" name="user">
                      <option value="">Please Select</option>
                      @foreach($users as $user)
                      <option value='{{ $user->id }}'>{{ $user->name }}</option>
                      @endforeach
                    </select>
                    <input type="submit" value="Show">
                    </form>             
                </div>
                
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
    </div>
</div>
<div class="row">
    <div class="col-12">
    <div class="card">
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div id="calendar"></div>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
    </div>
</div>


@push('scripts')
<!-- jQuery UI -->
<script src="{{ custom_asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ custom_asset('plugins/fullcalendar/main.min.js') }}"></script>
<script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        
        
        
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
            events: [
            @foreach($weeks as $k=>$week)
            {
                <?php
                $text = 'From : '.$week->date_from.' To : '.$week->date_to;
                if(isset($paid[$week->id]))
                {
                    $text .=' Paid ';
                    foreach($paid[$week->id] as $r)
                    {
                        $text .=' Transaction Date : '.$r->date.' Amount : '.$r->amount;
                    } 
                }
                else{
                    $text .=' Due ';
                }   
                ?>
                id: {{ $k }},
                title: '{{ $text }}',
                start: '{{ $week->date_from }}',
                end:  '{{ $week->date_to }}'
            },
            @endforeach

            
            
      ],  
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>
@endpush

@endsection