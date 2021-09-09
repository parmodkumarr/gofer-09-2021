@extends('protocol.admin.layout.app')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section ('content')
<div class="container-fluid">
    <div class="row">
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
        <div class="col-lg-12">
            <div class="card">    
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">{{$title}}</h4>
                </div>
                <div class="container">
                    <form action="{{route('PostAllOrdersList')}}" method="post" id="tableFilter">
                        @csrf
                    <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group">
                                <label for="pwd">Store:</label>
                                <select name="store[]"class="form-control select2" multiple="true">
                                    @foreach($stores as $store)
                                        <option value="">Select</option>
                                        <option value="{{$store->store_id}}">{{$store->store_name}}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                            <label for="pwd">Order Status:</label>
                                <select name="order_status" class="form-control">
                                    <option value="">Select</option>
                                    <option value="0">Canceled</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Delivered</option>
                                    <option value="4">Rejected By Store</option>
                                </select>
                            </div> 
                        </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" name="sreach" class="form-control">
                            </div>
                         </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" name="date" class="form-control daterange">
                            </div>
                         </div>
                         <input type="submit" name="submit" class="btn btn-primary">
                    </div>
                </form>
                    <div class="tableContainer" style="max-width: 855px;">
                        @include('protocol.admin.store.pagination_data')
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div> 
@endsection
@section ('scripts')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{url('assets/js/pagination.js?ddd=66636v35353')}}"></script>
    <script>
    $(document).ready( function () {

        $('.daterange').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

        $('#myTable').DataTable({
            "paging":   false,
            "ordering": false,
            "info":     false,
            searching: false,
        });
    } );
    </script>
@endsection