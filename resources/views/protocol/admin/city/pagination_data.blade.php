<div class="table-responsive">
    <table  class="table table-striped table-bordered" id="myTable">
         <thead>
        <tr>
            <th>#</th>
            <th>City Name</th>

            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
           @if(count($city)>0)
          @php $i=1; @endphp
          @foreach($city as $cities)
        <tr>
            <td class="text-center">{{$i}}</td>
            <td>{{$cities->city_name}}</td>

            <td class="td-actions text-center">
                <a href="{{route('cityedit',$cities->city_id)}}" rel="tooltip" class="btn btn-success">
                    <i class="material-icons">edit</i>
                </a>
               <a href="{{route('citydelete',$cities->city_id)}}" onClick="return confirm('Are You sure! It will remove all the Stores, User addresses, Delivery boys related to this City ')" rel="tooltip" class="btn btn-danger">
                    <i class="material-icons">close</i>
                </a>
            </td>
        </tr>
          @php $i++; 
          @endphp
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