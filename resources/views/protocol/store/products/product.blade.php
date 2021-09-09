@extends('store.layout.app')
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
             <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Update price/mrp</h4>
                 </div>
                     <div class="container"> <br> 
                    <table class="display" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Product Name</th>
                                <th>id</th>
                                <th>Current Discount</th>
                                <th>Current Price/Mrp</th>
                                <th>Add Price/Discount</th>
                               <!--  <th>Add Discount</th> -->
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                             
                      @if(count($selected)>0)
                      @php $i=1; @endphp
                      @foreach($selected as $sel)
                    <tr>
                        <td class="text-center">{{$i}}</td>
                        <td><p>{{$sel->product_name}}({{$sel->quantity}} {{$sel->unit}})</p></td>
                        <td><b>{{$sel->p_id}}</b></td>
                        <td><b>type : </b>
                          @if($sel->store_discount_type ==2)
                            Percentage
                          @elseif($sel->store_discount_type ==1)
                            Flat
                          @else
                            None
                          @endif
                          <br>
                        <b>amount : </b>{{$sel->total_discount}}</td>
                        <td><b>price : </b>{{$sel->price}}<br>
                        <b>mrp : </b>{{$sel->mrp}}</td>
                        <td>
                            
                         <form class="forms-sample" action="{{route('ProductUpdate', $sel->p_id)}}" method="post" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <div class="col-md-12">
                          <div class="col-md-8" style="float:left">
                             <div class="form-group">
                              <label class="bmd-label-floating">mrp</label>
                              <input type="number" step="0.10" name="mrp" class="form-control" value="{{$sel->mrp}}">
                            </div>
                            <div class="form-group">
                              <label class="bmd-label-floating">type</label>
                              <select name="discount_type" id="discount_type" class="form-control" >
                                  <option disabled="true" >{{__('Please Select')}}</option>
                                  <option value="1"  @if( $sel->store_discount_type ==1) selected @endif >{{__('Flat')}}</option>
                                  <option value="2"  @if( $sel->store_discount_type ==2) selected @endif >{{__('Percentage')}}</option>
                                  <option value="0"  @if( $sel->store_discount_type ==0) selected @endif >{{__('None')}}</option>
                              </select>

                            </div>
                            <div class="form-group">
                              <label class="bmd-label-floating">amount</label>
                              <input type="number" id="discount_amount" name="discount_amount" value="{{$sel->total_discount}}" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-4" style="float:left;margin-left: -20px;">
                          <button type="submit" style="border:none;background-color:transparent;float:left;width: 40px !important;height: 40px;border-radius: 50%;"><img style="float:left;width: 40px !important;height: 40px;border-radius: 50%;" src="{{url('images/icon/add.png')}}" alt="add"/></button>
                            </div>
                          </form>
                          </div>
                        </td>


<!-- 
                        <td>   
                         <form class="forms-sample" action="{{route('store_discount_update', $sel->p_id)}}" method="post" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <div class="col-md-12">
                          <div class="col-md-8" style="float:left">
                             <div class="form-group">
                              <label class="bmd-label-floating">type</label>
                              <select name="discount_type" id="discount_type" class="form-control" >
                                  <option disabled="true" >{{__('Please Select')}}</option>
                                  <option value="1"  @if( $sel->store_discount_type ==1) selected @endif >{{__('Flat')}}</option>
                                  <option value="2"  @if( $sel->store_discount_type ==2) selected @endif >{{__('Percentage')}}</option>
                                  <option value="0"  @if( $sel->store_discount_type ==0) selected @endif >{{__('None')}}</option>
                              </select>

                            </div>
                            <div class="form-group">
                              <label class="bmd-label-floating">amount</label>
                              <input type="number" id="discount_amount" name="discount_amount" value="" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-4" style="float:left;margin-left: -20px;">
                          <button type="submit" style="border:none;background-color:transparent;float:left;width: 40px !important;height: 40px;border-radius: 50%;"><img style="float:left;width: 40px !important;height: 40px;border-radius: 50%;" src="{{url('images/icon/add.png')}}" alt="add"/></button>
                            </div>
                          </form>
                          </div>
                        </td>


 -->
                        <td class="td-actions text-right">
                           <a href="{{route('delete_product', $sel->p_id)}}" rel="tooltip" class="btn btn-danger">
                                <i class="material-icons">close</i>
                            </a>
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
          </div>
     <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
@endsection




