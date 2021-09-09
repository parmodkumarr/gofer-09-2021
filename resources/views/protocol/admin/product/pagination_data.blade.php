<div class="table-responsive">
    <table  class="table table-striped table-bordered" id="myTable">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Product Name</th>
            <th>Product id</th>
            <th>Category</th>
            <th>Product_image</th>
            <th>Hide</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
           @if(count($product)>0)
          @php $i=1; @endphp
          @foreach($product as $products)
        <tr>
            <td class="text-center">#{{$products->product_id}}</td>
            <td>{{$products->product_name}}</td>
            <td>{{$products->product_id}}</td>
            <td> {{$products->title}}</td>
            <td><img src="{{url($products->product_image)}}" alt="image"  style="width:50px;height:50px; border-radius:50%"/></td>
            <td><input type="checkbox" data-id="{{ $products->product_id }}" name="status" class="js-switch" {{ $products->hide == 1 ? 'checked' : '' }}></td>
            <td class="td-actions text-right">
                <a href="{{route('EditProduct',$products->product_id)}}" rel="tooltip" class="btn btn-success">
                    <i class="material-icons">edit</i>
                </a>
                <a href="{{route('add.info.highlight',$products->product_id)}}" rel="tooltip" class="btn btn-success">
                    <i class="material-icons">info</i> 
                </a>
                <a href="{{route('varient',$products->product_id)}}" rel="tooltip" class="btn btn-primary">
                    <i class="material-icons">layers</i>
                </a>
                <a href="{{route('DeleteProduct',$products->product_id)}}" rel="tooltip" class="btn btn-danger">
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