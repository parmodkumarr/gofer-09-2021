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
                  <h4 class="card-title">Add Product</h4>
                  <form class="forms-sample" action="{{route('AddNewProduct')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                </div>
                <div class="card-body">


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Category</label>
                          <select name="parent_cat_id" id="parentCategory" class="form-control select2"  value="{{old('parent_cat_id')}}" >
                              <option disabled selected>Select Category</option>
                              @foreach($parentCategory as $categorys)
                                <option value="{{$categorys->cat_id}}"  >{{$categorys->title}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>

                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Sub-category</label>
                          <select name="cat_id" class="form-control select2" id="subcate" value="{{old('cat_id')}}" >
                             {{--
                              @foreach($category as $categorys)
                              
        		          	<option value="{{$categorys->cat_id}}">@if($categorys->level==1)-@endif @if($categorys->level==2)--@endif {{$categorys->title}}</option>
        		              @endforeach
                          --}}
                              
                          </select>
                        </div>
                      </div>

                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Discount Type</label>
                          <select name="discount_type" id="discount_type" class="form-control" value="{{old('discount_type')}}">
                              <option selected="true" disabled="true" >{{__('Please Select')}}</option>
                              <option value="0">{{__('None')}}</option>
                              <option value="1">{{__('Flat')}}</option>
                              <option value="2">{{__('Percentage')}}</option>
                          </select>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Discount Amount</label>
                          <input type="number" id="discount_amount" name="discount_amount" value="" class="form-control" value="{{old('discount_amount')}}">
                        </div>
                      </div>
                    </div>
          

 
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Product Name</label>
                          <input type="text" name="product_name" class="form-control" value="{{old('product_name')}}">
                        </div>
                      </div>

                    </div>
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Quantity</label>
                          <input type="number" name="quantity" class="form-control" value="{{old('quantity')}}" >
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Unit (G/KG/Ltrs/Ml)</label>
                          <!-- <input type="text" name="unit" class="form-control" pattern="[A-Za-z]{1-10}" title="KG/G/Ltrs/Ml etc" required> -->
                          <select name="unit"  class="form-control" value="{{old('unit')}}">
                            @foreach(Prductsunits() as $unit=>$name)
                              <option value="{{$unit}}"> &nbsp; {{$name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Increment Value</label>
                          <input type="number" name="increment_value" class="form-control" value="{{old('increment_value')}}" >
                          <span>add value according units e.g. add 1 for 1kg</span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">MRP</label>
                          <input type="number" step="0.01" name="mrp" class="form-control" value="{{old('mrp')}}">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Price</label>
                          <input type="number" step="0.01" name="price" class="form-control" value="{{old('price')}}" readonly>
                        </div>
                      </div>
                    </div>
                    
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form">
                          <label class="bmd-label-floating">Product Image</label>
                          <input type="file"name="product_image" class="form-control">
                        </div>
                      </div>
                    </div>
                    
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Description</label>
                          <textarea type="text" name="description" class="form-control">{{old('description')}}</textarea>
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
        $(function(){
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
                     var html =' <option disabled selected>Select Category</option>';
                     $.each(result.data, function( index, value ) {
                        html +="<option value='"+value.cat_id+"'>"+value.title+"</option>";
                    });
                     $('#subcate').html(html);
                   }
                });

            });
        });


      $('select[name="discount_type"]').change(function(){
      
      if($(this).val() == "Flat"){
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




