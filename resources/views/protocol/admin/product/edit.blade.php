@extends('protocol.admin.layout.app')

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
                  <h4 class="card-title">Edit Product</h4>
                  <form class="forms-sample" action="{{route('UpdateProduct', $product->product_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Category</label>
                          <select name="parent_cat_id" id="parentCategory" class="form-control select2"  value="{{old('parent_cat_id')}}" >
                              <option disabled>Select Category</option>
                              @foreach($parentCategory as $categorys)
                                <option value="{{$categorys->cat_id}}"@if($product->parent_cat_id == $categorys->cat_id) selected @endif>{{$categorys->title}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Sub-category</label>
                          <select name="cat_id" class="form-control select2" id="subcate" data-value="{{$product->cat_id}}" value="{{old('cat_id')}}" >
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 ">
                        <button type="button" class="btn pull-right btn-primary" ><a href="{{route('add.product.images',$product->product_id)}}" style="color: white;" >Add Product Images</a></button>
                      </div>
                  </div>
                  <br>

                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Product_name</label>
                          <input type="text" value="{{$product->product_name}}" name="product_name" class="form-control">
                        </div>
                      </div>

                    </div>
                    <img src="{{url($product->product_image)}}" alt="image" name="old_image" style="width:100px;height:100px; border-radius:50%">
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form">
                          <label class="bmd-label-floating">Product Image</label>
                          <input type="file"name="product_image" class="form-control">
                        </div>
                      </div>

                    </div>
                    <button type="submit" class="btn btn-primary pull-center">Submit</button>
                     <a href="{{route('productlist')}}" class="btn">Close</a>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
			</div>
          </div>
      <script type="text/javascript">
      function subcate(){
          var cateid= $('#parentCategory').val();
          var subcateid= $('#subcate').data('value');
          // alert(subcateid);
          $.ajax({
             type:'POST',
             url:"{{route('getsubcategorylist')}}",
             data:{
              cateid:cateid
             },
             success:function(result){
               var html =' <option disabled>Select Category</option>';
               $.each(result.data, function( index, value ) {
                  var select ='';
                  if(value.cat_id == subcateid){
                    select = 'selected';
                  }
                  html +="<option "+select+" value='"+value.cat_id+"'>"+value.title+"</option>";
              });
               $('#subcate').html(html);
             }
          });
      }

        $(function(){
          subcate();
            //$('#parentCategory').trigger('change'); //This event will fire the change event. 
            $('#parentCategory').change(function(e){
                e.preventDefault();
                var cateid= $(this).val();
                $.ajax({
                   type:'POST',
                   url:"{{route('getsubcategorylist')}}",
                   data:{
                    cateid:cateid
                   },
                   success:function(result){
                     var html =' <option disabled>Select Category</option>';
                     $.each(result.data, function( index, value ) {
                        html +="<option value'"+value.cat_id+"'>"+value.title+"</option>";
                    });
                     $('#subcate').html(html);
                   }
                });

            });
        });


      $('select[name="discount_type"]').change(function(){
      
      if($(this).val() == "1"){
        // var amount = "100";
        // $('#discount_amount').val(amount);
      }

      if($(this).val() == "2"){
        var amount = "100";
        if(amount>100){
          $('#discount_amount').val('0');
        }
      }

    });

    $("input[name='discount_amount']").change(function() {
      number = $("input[name='discount_amount']").val();
      var discount_type = $('#discount_type').val();
          if(discount_type == '2'){   
           if( number <= 0 || number >= 100 ) {
               // $("input[name='discount_amount']").val("");
               $('#discount_amount').val(100);
             }
          }
       });

      </script>
@endsection




