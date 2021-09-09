<div class="table-responsive">
    <table  class="table table-striped table-bordered" id="myTable">
         <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Quantity</th>
            <th>Unit</th>
            <th>varient_image</th>
            <th>Description</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
           @if(count($product)>0)
          @php $i=1; @endphp
          @foreach($product as $products)
        <tr>
            <td class="text-center">{{$i}}</td>
            <td>{{$products->quantity}}</td>
            <td> {{$products->unit}}</td>
            <td><img src="{{url($products->varient_image)}}" alt="image"  style="width:50px;height:50px; border-radius:50%"/></td>
            <td> {{$products->description}}</td>
            <td class="td-actions text-right">
                <a href="{{route('edit-varient',$products->varient_id)}}" rel="tooltip" class="btn btn-success">
                    <i class="material-icons">edit</i>
                </a>
                <a href="{{route('delete-varient',$products->varient_id)}}" rel="tooltip" class="btn btn-danger">
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
        {!! $product->links() !!}
    </div>
</div>