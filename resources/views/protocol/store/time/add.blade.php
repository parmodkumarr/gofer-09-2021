@extends('protocol.store.layout.app')

@section ('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
 <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Time Slot List</h4>
                </div>
                <div class="container">
                    <table class="display dataTable no-footer" id="myTable">
                      <thead>
                      <tr>
                      <th class="text-center">#</th>
                      <th>Day</th>
                      <th>Open Time</th>
                      <th>Close Time</th>
                      <th>Time Slot</th>
                      <th>Status</th>
                      <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        @php
                        $i=1;
                        @endphp
                      @foreach($timeslot as $time)
                      <tr>
                        <td>#{{$i}}</td>
                        <td>{{$days[$time->day]}}</td>
                        <td>{{$time->opening_time}}</td>
                        <td>{{$time->closing_time}}</td>
                        <td>{{$time->time_slot}}</td>
                        <td>
                          @if($time->status ==1)
                          Active
                          @else
                          Inactive
                          @endif
                        </td>
                          <td class="td-actions text-right">
                            <a href="{{route('stor_add_timeslot',$time->id)}}" rel="tooltip" class="btn btn-success" data-original-title="" title="">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div></a>
                            <a href="{{route('stor_delete_timeslot',$time->id)}}" rel="tooltip" class="btn btn-danger" data-original-title="" title="">
                            <i class="material-icons">close</i>
                            </a>
                        </td>
                      </tr>
                      @php
                        $i++;
                        @endphp
                      @endforeach
                      </tbody>
                    </table>
              </div>
              </div>
            </div>
            <div class="col-lg-12">
                @if (session()->has('success'))
                <div class="alert alert-success">
                  @if(is_array(session()->get('success')))
                    <ul>
                        @foreach (session()->get('success') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                  @else
                      {{ session()->get('success') }}
                  @endif
                </div>
                @endif
                 @if (count($errors) > 0)
                  @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                      {{$errors->first()}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                  @endif
                @endif
            </div>
            @if($times)
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Edit Time Slot </h4>
                  <form class="forms-sample" action="{{route('stor_add_timeslot_post',$id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                </div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Days</label>
                          <select name="day" class="form-control">
                            <option value="">--Select--</option>
                            @foreach($days as $key=>$day)
                            <option value="{{$key}}" @if($times->day == $key) selected @endif>{{$day}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Open Time</label>
                          <input type="text" name="opening_time" class="form-control timepicker" value=" {{$times->opening_time}}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Close Time</label>
                          <input type="text" name="closing_time" class="form-control timepicker" value="{{$times->closing_time}}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Time Slot</label>
                          <input type="number" name="time_slot" class="form-control" value="{{$times->time_slot}}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Status</label>
                           <select name="status" class="form-control">
                            <option value="">Select</option>
                              <option value="1" @if($times->status =="1") selected @endif>Active</option>
                              <option value="0" @if($times->status =="0") selected @endif>Inactive</option>
                            </select>
                        </div>
                      </div>
                 </div>
                 <input type="hidden" name="store_id" value="{{$store->store_id}}">
                    <button type="submit" class="btn btn-primary pull-center">Submit</button>
                    <!-- <a href="{{route('catlist')}}" class="btn">Close</a> -->
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            @else
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Time Slot </h4>
                  <form class="forms-sample" action="{{route('stor_add_timeslot_post')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                </div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Days</label>
                          <select name="day" class="form-control">
                            @foreach($days as $key=>$day)
                            <option value="{{$key}}">{{$day}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Open Time</label>
                          <input type="text" name="opening_time" class="form-control timepicker" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Close Time</label>
                          <input type="text" name="closing_time" class="form-control timepicker" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Time Slot</label>
                          <input type="number" name="time_slot" class="form-control" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Status</label>
                           <select name="status" class="form-control">
                            <option value="">Select</option>
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                        </div>
                      </div>
                 </div>
                 <input type="hidden" name="store_id" value="{{$store->store_id}}">
                    <button type="submit" class="btn btn-primary pull-center">Submit</button>
                    <!-- <a href="{{route('catlist')}}" class="btn">Close</a> -->
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            @endif
      </div>
          </div>
      <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script type="text/javascript">
      $('.timepicker').timepicker({});
    </script>
@endsection




