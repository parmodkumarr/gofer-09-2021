<div class="table-responsive">
    <table  class="table table-striped table-bordered" id="myTable">
       <thead>
            <tr>
            <th class="text-center">#</th>
              <!--<th>ID</th>-->
              <th>Store Owner Name</th>
              <th>Email Address</th>
              <th>Mobile</th>
              <!-- <th>orders</th> -->
              <th>Action</th>
            </thead>
            <tbody>
                 @if(count($storeOwner)>0)
                  @php $i=1; @endphp
                  @foreach($storeOwner as $ownerDetail)
                    <tr>
                        <td class="text-center">{{$i}}</td>
                        <td>{{$ownerDetail->name}}</td>
                        <td>{{$ownerDetail->email}}</td>
                        <td>{{$ownerDetail->phone}}</td>
                        <td class="td-actions text-center">
                            <a href="{{route('store.owner.edit', $ownerDetail->id)}}" button type="button" class="btn btn-success">
                                <i class="material-icons">edit</i>
                            </button></a>
                            <a target="_blank" rel="noopener noreferrer" href="{{route('store.owner.store.list', $ownerDetail->id)}}" style="padding-top:24px; background-color:black" button type="button" class="btn btn-success">
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
        {!! $storeOwner->links() !!}
    </div>
</div>