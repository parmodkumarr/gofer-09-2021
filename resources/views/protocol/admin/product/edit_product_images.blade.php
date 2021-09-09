@extends('protocol.admin.layout.app')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
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
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Product Images</h4>
                  <form class="forms-sample" action="{{route('update.product.images')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                </div>
                <div class="card-body">
                     <input type="hidden" name="id" value="{{$product->product_id}}">

                    <img src="{{url($product->product_image)}}" alt="image" name="old_image" style="width:100px;height:100px; border-radius:50%">
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form">
                          <label class="bmd-label-floating">Product Image</label>
                          <input type="file"name="product_image[]" multiple="true" class="form-control">
                        </div>
                      </div>

                    </div>
                    <button type="submit" class="btn btn-primary pull-center">Submit</button>
                     <a href="{{route('productlist')}}" class="btn">Close</a>
                    <div class="clearfix"></div>


                    <div class="row">
                        <div class="col-md-12">
                          <table class="display" id="myTable">
                              <thead>
                                  <tr>
                                      <th class="text-center">#</th>
                                      <th>Image</th>
                                      <th>Category ID</th>
                                      <th class="text-right">status</th>
                                  </tr>
                              </thead>
                              <tbody id="allproductshere" >
                                  @if(count($productImages)>0)
                                    @foreach($productImages as $index => $row)
                                      <tr >
                                        <td class="text-center">{{$index+1}}</td>
                                        <td><img src="{{url($row->image)}}" alt="category image" style="width:50px; height:50px; border-radius:50%;"/></td>
                                        <td>{{$row->product_id}}</td>
                                        <td ><button type="button" class="btn pull-right btn-primary" ><a href="{{route('delete.product.images',$row->id)}}" style="color: white;" >Delete</a></button></td>
                                      </tr>
                                    @endforeach
                                  @endif

                              </tbody>
                          </table>
                        </div>
                      </div>


                  </form>
                </div>
              </div>
            </div>
			</div>
          </div>
          <script type="text/javascript">
                $(document).ready(function() {
      $('#myTable').DataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false });
      });
          </script>
@endsection




