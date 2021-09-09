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
     <a href="{{route('section.type.create')}}" class="btn btn-primary ml-auto" style="width:10%;float:right;padding: 3px 0px 3px 0px;"><i class="material-icons">add</i>Add Type</a>
</div>     
<div class="col-lg-12">
<div class="card">    
<div class="card-header card-header-primary">
      <h4 class="card-title ">Store List</h4>
    </div>
<div class="container"> <br> 
<table class="display" id="myTable">    
    <thead>
        <tr>
            <th class="text-center">#</th>
                      <!--<th>ID</th>-->
                      <th>Section Type Name</th>
                      <th>Active</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                         @if(count($sectionTypes)>0)
                          @php $i=1; @endphp
                          @foreach($sectionTypes as $row)
                            <tr>
                                <td class="text-center">{{$i}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->is_active}}</td>
<!-- 
                                <td><a href="{{route('admin_store_orders', $row->id)}}" rel="tooltip">
                                <i class="material-icons" style="color:green">layers</i></a></td> -->
                                <td class="td-actions text-center">
                    
                                    <a href="{{route('section.type.edit',$row->id)}}" button type="button" class="btn btn-success">
                                        <i class="material-icons">edit</i>
                                    </button></a>

                                     <!-- <a href="{{route('storedelete', $row->id)}}" button type="button" class="btn btn-danger">
                                        <i class="material-icons">close</i>
                                    </button></a> -->
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
 <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
    @endsection
</div>