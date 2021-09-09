<div class="table-responsive">
    <table  class="table table-striped table-bordered" id="myTable">
        <thead>
        <tr>
            <th> # </th>
            <th>Boy Name</th>
            <th>Boy Phone</th>
            <th>Boy Password</th>
            <th>Status</th>
            <th>Orders</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
           @if(count($d_boy)>0)
          @php $i=1; @endphp
          @foreach($d_boy as $d_boys)
        <tr>
            <td class="text-center">{{$i}}</td>
            <td>{{$d_boys->boy_name}}</td>
           
            <td>{{$d_boys->boy_phone}}</td>
       
            <td>{{$d_boys->password}}</td>
            @if($d_boys->status == 1)
            <td><p style="color:green">on duty</p></td>
            @else
            <td><p style="color:red">off duty</p></td>
            @endif
            <td><a href="{{route('admin_dboy_orders',$d_boys->dboy_id)}}" rel="tooltip" class="btn btn-primary">
                    <i class="material-icons">layers</i></td>
            <td class="td-actions text-right">
                <a href="{{route('EditD_boy',$d_boys->dboy_id)}}" rel="tooltip" class="btn btn-success">
                    <i class="material-icons">edit</i>
                </a>
               <a href="{{route('DeleteD_boy',$d_boys->dboy_id)}}" rel="tooltip" class="btn btn-danger">
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
    <div class="d-flex justify-content-center paginationLinks">
        {!! $d_boy->links() !!}
    </div>
</div>