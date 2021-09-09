<div class="table-responsive">
    <table  class="table table-striped table-bordered" id="myTable">
        <thead>
            <tr>
            <th class="text-center">#</th>
            <!--<th>ID</th>-->
            <th>Store Name</th>
            <th>City</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Admin Share</th>
            <th>orders</th>
            <th>Action</th>
        </thead>
            <tbody>
             @if(count($city)>0)
              @php $i=1; @endphp
              @foreach($city as $cities)
                <tr>
                    <td class="text-center">{{$i}}</td>
                    <td>{{$cities->store_name}}</td>
                    <td>{{$cities->city}}</td>
                    <td>{{$cities->phone_number}}</td>
                    <td>{{$cities->email}}</td>
                    <td>{{$cities->admin_share}} %</td>
                    <td><a href="{{route('admin_store_orders', $cities->store_id)}}" rel="tooltip">
                    <i class="material-icons" style="color:green">layers</i></a></td>
                    <td class="td-actions text-center">

                        <a href="{{route('storedit', $cities->store_id)}}" button type="button" class="btn btn-success">
                            <i class="material-icons">edit</i>
                        </button></a>
                         <a href="{{route('storedelete', $cities->store_id)}}" button type="button" class="btn btn-danger">
                            <i class="material-icons">close</i>
                        </button></a>
                        <a target="_blank" rel="noopener noreferrer" href="{{route('secret-login', $cities->store_id)}}" style="padding-top:24px; background-color:black" button type="button" class="btn btn-success">
                           <i class="fa fa-user-secret fa-2x"></i>
                        </button></a>
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
    <div class="d-flex justify-content-center paginationLinks">
        {!! $city->links() !!}
    </div>
</div>