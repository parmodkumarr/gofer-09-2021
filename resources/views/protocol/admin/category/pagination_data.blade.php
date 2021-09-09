<div class="table-responsive">
    <table  class="table table-striped table-bordered" id="myTable">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Cat Name</th>
            <th>Parent Category</th>
            <th>Cat image</th>
            <th>Cat id</th>
            <th class="text-right">Actionss</th>
        </tr>
    </thead>
    <tbody>
        @if(count($category)>0)
        @php $i=1; @endphp
        @foreach($category as $cat)
        <tr>
            <td class="text-center">#{{$cat->cat_id}}</td>
            <td>{{$cat->title}}</td>
            @if($cat->parent == 0)
            <td>-------</td>
            @endif
            @if($cat->parent != 0)
            <td>{{$cat->tttt}}</td>
            @endif
            <td><img src="{{url($cat->image)}}" alt="category image" style="width:50px; height:50px; border-radius:50%;"/></td>
            <td>{{$cat->cat_id}}</td>
            <td class="td-actions text-right">
                <a href="{{route('EditCategory',$cat->cat_id)}}" rel="tooltip" class="btn btn-success">
                    <i class="material-icons">edit</i>
                </a>
               <a href="{{route('DeleteCategory',$cat->cat_id)}}" rel="tooltip" class="btn btn-danger">
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
        {!! $category->links() !!}
    </div>
</div>