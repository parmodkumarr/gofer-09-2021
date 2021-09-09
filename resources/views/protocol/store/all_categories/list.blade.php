@extends('protocol.store.layout.app')
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
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New</button>

     <!-- <a href="{{route('add.categories.section')}}" class="btn btn-primary ml-auto" style="width:15%;float:right;padding: 3px 0px 3px 0px;"><i class="material-icons">add</i>Add Categories Section</a> -->
</div> 
<div class="col-lg-12">
<div class="card">    
<div class="card-header card-header-primary">
      <h4 class="card-title ">All Categories List</h4>
    </div>
<div class="container"><br>    
<table class="display" id="myTable">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Categoy Section Title</th>
            <th>Product id</th>
            <th>Category</th>
            <th>Product_image</th>
            <th>Hide</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
           @if(count($all_categories)>0)
          @php $i=1; @endphp
          @foreach($all_categories as $products)
        <tr>
            <td class="text-center">{{$i}}</td>
            <td>{{ ucfirst($products->title) }}</td>
            <td>{{$products->id}}</td>
            <td> {{$products->title}}</td>
            @if($products->image == "")
                <td><img src="{{url('')}}" alt="image"  style="width:50px;height:50px; border-radius:50%"/>No Image</td>
            @else
            <td><img src="{{url($products->image)}}" alt="image"  style="width:50px;height:50px; border-radius:50%"/></td>
            @endif
            <!-- <td><input type="checkbox" data-id="{{ $products->id }}" name="status" class="js-switch" {{ $products->id == 999 ? 'checked' : '' }}></td> -->
            <td class="td-actions text-right">
                <a href="{{route('edit.categories.section',$products->id)}}" rel="tooltip" class="btn btn-success">
                    <i class="material-icons">edit</i>
                </a>
                <!-- <a href="{{route('varient',$products->id)}}" rel="tooltip" class="btn btn-primary">
                    <i class="material-icons">layers</i>
                </a>
                <a href="{{route('DeleteProduct',$products->id)}}" rel="tooltip" class="btn btn-danger">
                    <i class="material-icons">close</i>
                </a> -->
            </td>
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
    </div>
    </div>
    </div>
    </div>
    </div>
    <div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
          </div>
          <div class="modal-body">
            <form action="{{route('submit.categories.newsection')}}" id="ajax-submit" class="section-creation-form" method="post" enctype="multipart/form-data" style="">
                   <div class="row">
                      <div class="col-md-12">
                         <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Title</label>
                            <input type="text" name="title" id="title" value="" class="form-control">
                            @csrf
                         </div>
                      </div>
                   </div>
                   <div class="row">
                       <div class="col-md-12">
                         <label class="bmd-label-floating">Description</label>
                           <textarea class="form-control" name="description" id="description"></textarea>
                       </div>
                   </div>
                   <div class="row">
                      <div class="col-md-12">
                         <div class="form">
                            <label class="bmd-label-floating">Image</label>
                            <input type="file" accept="image/png, image/jpeg" name="image" id="image" class="form-control">
                         </div>
                      </div>
                   </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Create</button>
               </div>
            </form>
        </div>

      </div>
    </div>
</div>
     <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
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