@extends('protocol.admin.layout.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<style>
    .material-icons{
        margin-top:0px !important;
        margin-bottom:0px !important;
    }
</style>
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

     <!-- <a href="" class="btn btn-primary ml-auto" style="width:15%;float:right;padding: 3px 0px 3px 0px;"><i class="material-icons">add</i>Add Product</a> -->
</div> 
<div class="col-lg-12">
<div class="card">    
<div class="card-header card-header-primary">
      <h4 class="card-title ">Request List</h4>
    </div>
<div class="container"><br>    
<table class="display" id="myTable">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Message</th>
            <th>Product Name</th>
            <th>Request Quantity</th>
            <th>Store Name</th>
            <th>Store Email</th>
            <th class="text-right">Store Number</th>
            <th class="text-right">Action</th>
        </tr>
    </thead>
    <tbody>
           @if(count($requestq)>0)
          @php $i=1; @endphp
          @foreach($requestq as $request)
        <tr>
            <td class="text-center">{{$i}}</td>
            <td>{{$request->not_title}}</td>
            <td>{{$request->product_name}}  ({{$request->product_quantity}})</td>
            <td> {{$request->quantity}}</td>
            <td>{{$request->store_name}}</td>
            <td>{{$request->email}}</td>
            <td>{{$request->phone_number}}</td>
            <td><button type="button" class="btn btn-info btn-lg allocate" data-toggle="modal" data-target="#myModal" data-product_id="{{$request->product_id}}" data-varient_id="{{$request->varient_id}}" data-store_id="{{$request->store_id}}" data-not_id="{{$request->not_id}}" >Allocate</button></td>
        </tr>
          @php $i++; @endphp
                 @endforeach
                  @else
                    <tr>
                      <td>No data found</td>
                    </tr>
                  @endif
    </tbody>
</table>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Allocate Product Quantity</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        <form action="{{route('AllocateStock')}}">
          <div class="modal-body">
            <input type="hidden" name="varient_id" class="varient_id">
            <input type="hidden" name="product_id" class="product_id">
            <input type="hidden" name="store_id" class="store_id">
            <input type="hidden" name="not_id" class="not_id">
            <div class="form-group">
              <label for="pwd">Allocate Quantity :</label>
              <input type="text" class="form-control allocate_quantity" placeholder="Allocate Quantity" name="allocated_quantity">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
    </div>

  </div>
</div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div>
    </div>
     <script>
        $(document).ready( function () {
            $('#myTable').DataTable();

            $( ".allocate" ).click(function() {
              $('.varient_id').val($(this).data('varient_id'));
              $('.product_id').val($(this).data('product_id'));
              $('.store_id').val($(this).data('store_id'));
              $('.not_id').val($(this).data('not_id'));
            });
        } );
    </script>
    <script>
    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'small' });
    });
    </script>
<script>
    $(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let product_id = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route("hideprod") }}',
            data: {'status': status, 'product_id': product_id},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
});
</script>
     
    @endsection
</div>