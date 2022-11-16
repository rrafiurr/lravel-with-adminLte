@extends('layout.layout')
@section('content')

<div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
                @endforeach
            </ul>  
            <form action="{{ url('transactions') }}"  method="post">
              @csrf    
                <div class="card-body">
                  <div class="form-group">
                    <label>Member : *</label>
                    <select class="form-control select2" style="width: 100%;" name="user_id">
                      <option value="">Please Select</option>
                      @foreach($users as $user)
                      <option value='{{ $user->id }}'>{{ $user->name }} - {{ $user->phone_no }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Transaction Media : *</label>
                    <select class="form-control select2" style="width: 100%;" name="transaction_medias_id">
                      <option value="">Please Select</option>
                      @foreach($transaction_media as $media)
                      <option value='{{ $media->id }}'>{{ $media->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Amount</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" name="amount" value="{{ old('amount') }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Payment Details</label>
                    <textarea class="form-control" name="proof">
                    {{ old('proof') }}
                    </textarea>
                  </div>
                  <!-- <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div> -->
                  <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            
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