<div class="table-responsive">
    <table  class="table table-striped table-bordered" id="myTable">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Order ID</th>
                <th>Cart price</th>
                <th>User</th>
                <th>Service Tax</th>
                <th>Delivery Charge</th>
                <th>Order Status</th>
                <th>Details</th>
                <th>Action</th>
            </tr>
     </thead>
    <tbody>
    @if(count($ord)>0)
        @php $i=1; @endphp
        @foreach($ord as $ords)
            <tr>
                <td class="text-center">{{$i}}</td>
                <td>{{$ords->order_id}}</td>
                <td>{{$ords->total_price}}</td>
                <td>{{$ords->user_name}}({{$ords->user_phone}})</td>
                <td>{{$ords->tax}}</td>
                <td>
                    <p>
                        <span style="color:grey">{{$ords->delivery_charge}}</span>
                        ( {{$ords->delivery_charge_km}}/Km * {{$ords->delivery_distance}}(Distance))
                    </p>
                </td>
                <td>
                    @if($ords->order_status == '4')
                        Delivered
                    @elseif($ords->order_status == '0')
                        Canceled
                    @elseif($ords->order_status != '4' || $ords->order_status != '6' || $ords->order_status != '0')
                        Pending
                    @else
                        Rejected
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal{{$ords->order_id}}" style="padding:5;">user`s</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeModal{{$ords->order_id}}"style="padding:5;">store`s</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#driverModal{{$ords->order_id}}"style="padding:5;">drivers`s</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1{{$ords->order_id}}"style="padding:5;">Items</button>
                </td>
                <td></td>
                <!-- <td>
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal11{{$ords->order_id}}">Assign Store</button>
                </td>
                 <td><button type="button" class="btn btn-alert" data-toggle="modal" data-target="#exampleModal2{{$ords->order_id}}">Reject</button> -->
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
    <div class="d-flex justify-content-center paginationLinks">
        {!! $ord->links() !!}
    </div>
</div>

@if(count($ord)>0)
    <!--/////////details model//////////-->
    @foreach($ord as $ords)
        <div class="modal fade" id="exampleModal1{{$ords->order_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order Details (<b>{{$ords->order_id}}</b>)</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <!--//form-->
                    <table class="table table-bordered" id="example2" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                        <th>product details</th>
                        <th>order qty</th>
                        <th>Actual Price</th>
                        <th>Discount</th>
                        <th>Final Price</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      @if(count($ords->details)>0)
                            @php 
                            $i=1;
                            @endphp
                                      
                          <tr>   
                        @foreach($ords->details as $detailss)
                            <td><p><img style="width:25px;height:25px; border-radius:50%" src="{{url($detailss->product_image)}}" alt="$detailss->product_name">  {{$detailss->product_name}}({{$detailss->stock}}{{$detailss->unit}})</p>
                            </td>
                            <td>{{$detailss->quantity}} {{$detailss->unit}}</td>
                            <td> 
                            <p>{{$detailss->price}}</p>
                           </td>
                           <td><p>{{$detailss->total_discount}}</p></td>
                           <td><p>{{$detailss->final_price}}</p></td>
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
                    <!--//form-->
                
                </div>
            </div>
        </div>

    <div class="modal fade" id="userModal{{$ords->order_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                      <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">City</th>
                            <th scope="col">Address</th>
                            <th scope="col">Other Address</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                           <td scope="row">{{$ords->user_name}}</td>
                            <td scope="row">{{$ords->user_phone}}</td>
                            <td scope="row">{{$ords->user_email}}</td>
                            <td scope="row">{{$ords->receiver_city}}</td>
                            <td scope="row">{{$ords->receiver_address}}</td>
                            <td scope="row">{{$ords->receiver_other_address}}</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <!-- detail model -->
        <div class="modal fade" id="storeModal{{$ords->order_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Store Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <table class="table">
                      <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">City</th>
                            <th scope="col">Address</th>
                            <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                           <td scope="row">{{$ords->store_name}}</td>
                            <td scope="row">{{$ords->store_phone}}</td>
                            <td scope="row">{{$ords->store_email}}</td>
                            <td scope="row">{{$ords->store_city}}</td>
                            <td scope="row">{{$ords->store_address}}</td>
                            <td scope="row">
                                @if($ords->store_status ==1)
                                Active
                                @else
                                Inactive
                                @endif
                            </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
     <!-- detail model -->
    <div class="modal fade" id="driverModal{{$ords->order_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Driver Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <table class="table">
                      <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">City</th>
                            <th scope="col">Address</th>
                            <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                           <td scope="row">{{$ords->boy_name}}</td>
                            <td scope="row">{{$ords->boy_phone}}</td>
                            <td scope="row">{{$ords->boy_city}}</td>
                            <td scope="row">{{$ords->boy_loc}}</td>
                            <td scope="row">
                                @if($ords->dboy_status ==1)
                                Active
                                @else
                                Inactive
                                @endif
                            </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
     @endforeach
@endif