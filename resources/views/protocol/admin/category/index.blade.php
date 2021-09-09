@extends('protocol.admin.layout.app')
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
     <a href="{{route('AddCategory')}}" class="btn btn-primary ml-auto" style="width:16%;float:right;padding: 3px 0px 3px 0px;"><i class="material-icons">add</i>Add Category</a>
    <br>
   </div> 
<div class="col-lg-12">
<div class="card">    
<div class="card-header card-header-primary">
      <h4 class="card-title ">Category List</h4>
    </div>
<div class="container tableContainer">
    @include('protocol.admin.category.pagination_data')
</div>
</div>
</div>
</div>
</div>
<div>
</div>
</div>
@endsection

@section ('scripts')
    <script src="{{url('assets/js/pagination.js')}}"></script>
    <script>
    $(document).ready( function () {
        $('#myTable').DataTable( {
            "paging":   false,
            "ordering": false,
            "info":     false
        });
    } );
    </script>
@endsection
