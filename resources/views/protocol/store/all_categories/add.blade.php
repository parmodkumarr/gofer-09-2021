<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
@extends('protocol.store.layout.app')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
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
                  <h4 class="card-title">Add Category Section</h4>
    <form class="forms-sample" action="{{route('submit.categories.section')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <input type="hidden" name="store_id" value="{{$store->store_id}}">
                </div>
                <div class="card-body">


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Title</label>
                          <input type="text" name="title" class="form-control">
                        </div>
                      </div>
                    </div>
                    <br><br>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Description</label>
                          <textarea name="description" class="form-control" >  </textarea>
                        </div>
                      </div>
                    </div>


                    <br><br>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Discount Type</label>
                          <select name="discount_type" id="discount_type" class="form-control" >
                              <option selected="true" disabled="true" >{{__('Please Select')}}</option>
                              <option value="1"  >{{__('Flat')}}</option>
                              <option value="2"  >{{__('Percentage')}}</option>
                              <option value="0"   >{{__('None')}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Discount Amount</label>
                          <input type="number" id="discount_amount" name="discount_amount" value="" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <a href="javascript:void(0)" onclick="getSelectedDiscountedCategories($('#discount_amount').val(),$('#discount_type').val())" id="search" >Search</a>
                        </div>
                      </div>
                    </div>


                    <br>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form">
                          <label class="bmd-label-floating">Cover Image</label>
                          <input type="file"name="image" class="form-control">
                        </div>
                      </div>
                    </div>

                    <br>

                    <!-- <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">All Selected Sub-Categories</label><br>
                          
                            <select data-placeholder="Begin typing a name to filter..." multiple class="chosen-select" name="categoryIds[]" id="allSelectedValues">
                                  @foreach($parentCategory as $index => $category)
                                    <option value="{{$category->cat_id}}" > {{$category->title}} </option>
                                  @endforeach
                            </select>
                        </div>
                      </div>
                    </div> -->

                      <div class="row">
                        <div class="col-md-12">
                          <table class="display" id="myTable">
                              <thead>
                                  <tr>
                                      <th class="text-center">#</th>
                                      <th>Image</th>
                                      <th>Category Name</th>
                                      <th>Category ID</th>
                                      <th class="text-right">status</th>
                                  </tr>
                              </thead>
                              <tbody id="allproductshere" >
                              </tbody>
                          </table>
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

      <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
      <script type="text/javascript">



        $(document).ready(function() {
          $('#myTable').DataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
          });
        });


        $(".chosen-select").chosen({
          no_results_text: "Oops, nothing found!"
        })
      
        $(function(){
            $('#parentCategory').trigger('change'); //This event will fire the change event. 
            $('#parentCategory').change(function(){
              var data= $(this).val();
              
              $('.hide-all').hide();
              $('.'+data).show();
              
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





    function getSelectedDiscountedCategories(discount_amount,discount_type){
        
            $("#allproductshere").empty();
            
            jQuery.ajax({
              url: "{{ route('fetch.discounted.categories') }}",
              method: 'post',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                 discount_amount: discount_amount,
                 discount_type : discount_type,
              },
              success: function(result){
                // console.log(result);

                if(result.status == 200){
                  var toAppend = '';
                    // console.log(result.data);
                    var ii = 0;
                    $.each(result.data, function(i,o){
                      console.log(o.description); 
                      // check = arrayCheck(o.cat_id,arrayFromPHP);
                      check = "";
                      ii +=1;
                      toAppend +=   '<tr ><td class="text-center">'+ii+'</td><td><img src="'+o.image+'" alt="category image" style="width:50px; height:50px; border-radius:50%;"/></td><td>'+o.title+'</td><td>'+o.cat_id+'</td><td onclick="getContent('+o.cat_id+')" ><input '+check+' value="'+o.cat_id+'" name="categoryIds[]" type="checkbox" ></td></tr>';

                    });

                    $('#allproductshere').append(toAppend);

                }

              }});
        

    }

    function getContent(cat_id){
              if(cat_id==''){
                alert('Something went Wrong');
              }else{

                var product_id = cat_id;
                var section_id = $('#section_id').val();
                var section_type = $('#section_type').val();

                jQuery.ajax({

                    url: "{{ route('save.subcategory.content') }}",
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                       product_id: product_id,
                       section_id: section_id,
                       section_type: section_type
                    },
                    success: function(result){
                      // console.log(result);
                      if(result.status == 200){

                      }

                  }});
              }     
          }




      </script>
@endsection




