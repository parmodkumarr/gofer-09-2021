@extends('protocol.admin.layout.app')
<style>
sup {
    color:red;
    position: initial;
    font-size: 111%;
}
</style>
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
                  <h4 class="card-title">Update Varient</h4>
                  <form class="forms-sample" action="{{route('update-varient', $varient_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                </div>
                <div class="card-body">
                   
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Quantity</label>
                          <input type="text" name="quantity" class="form-control" value="{{$product->quantity}}">
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Unit (G/KG/Ltrs/Ml)</label>
                          <select name="unit"  class="form-control" value="{{$product->unit}}">
                            @foreach(Prductsunits() as $unit=>$name)
                              <option value="{{$unit}}" @if($unit==$product->unit) selected @endif> &nbsp; {{$name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Discount Type</label>
                    {{--      
                          @if($product->discount_type == "Percentage" || $product->discount_type == "")
                            <input type="text"  id="discount_type" name="discount_type" readonly="true" value="Percentage" class="form-control">
                          @elseif($product->discount_type == "Flat" )
                            <input type="text"  id="discount_type" name="discount_type" readonly="true" value="Flat" class="form-control">
                          @endif
                    --}}
                          <select name="discount_type" id="discount_type" class="form-control" >
                              <option selected="true" disabled="true" >{{__('Please Select')}}</option>
                              <option value="1" @if( $product->discount_type == '1' ) selected @endif >{{__('Flat')}}</option>
                              <option value="2" @if( $product->discount_type == '2' ) selected @endif >{{__('Percentage')}}</option>
                              <option value="0" @if( $product->discount_type == '0' ) selected @endif >{{__('None')}}</option>
                          </select>

                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Discount Amount</label>
                          <input type="number" id="discount_amount" name="discount_amount" value="{{$product->discount_amount}}" class="form-control">
                        </div>
                      </div>
                    </div>


                      <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputName1">MRP</label>
                          <input  type="number" step="0.01" class="form-control" id="exampleInputName1" name="mrp" value="{{$product->base_mrp}}" placeholder="Enter MRP">
                        </div>
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Price</label>
                          <input  type="number" step="0.01" name="price" class="form-control" value="{{$product->base_price}}" readonly>
                        </div>
                      </div>
                    </div>
                     <img src="{{url($product->varient_image)}}" alt="image" name="old_image" style="width:100px;height:100px; border-radius:50%">
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form">
                          <label class="bmd-label-floating">Varient Image</label>
                          <input type="file"name="varient_image" class="form-control">
                        </div>
                      </div>
                    </div>
                    
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Description</label>
                          <textarea type="text" name="description" class="form-control">{{$product->description}}</textarea>
                        </div>
                      </div>
                    </div>


                    <button type="submit" class="btn btn-primary pull-center">Submit</button>
                    <a href="{{route('varient',$product->product_id)}}" class="btn">Close</a>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
			</div>
          </div>       

      <script>
        
      $('select[name="discount_type"]').change(function(){
      
      if($(this).val() == "1"){
        var amount = "{{$product->discount_amount}}";
        $('#discount_amount').val(amount);
      }

      if($(this).val() == "2"){
        var amount = "{{$product->discount_amount}}";
        if(amount>100){
          $('#discount_amount').val('0');
        }
      }

    });

    $("input[name='discount_amount']").change(function() {
      number = $("input[name='discount_amount']").val()
      var type = $('#discount_type').val();
      if(type == '2'){
          if( number <= 0 || number >= 100 ) {
               $('#discount_amount').val(100);
          }
      }

       });

      </script>

@endsection