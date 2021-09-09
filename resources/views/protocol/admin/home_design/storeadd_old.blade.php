@extends('protocol.admin.layout.app')
@section ('content')

<div class="row">
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
                  <h4 class="card-title">Home Section Edit</h4>
                </div>
                <div class="card-body">


                  <form class="forms-sample" action="{{route('update.section')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Section Name</label>
                          <input type="text" value="{{$section->name}}" name="section_name" class="form-control">
                          <input type="hidden" value="{{$section->id}}" name="section_id" id="section_id" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Section Type</label>
                              @if($section->section_type==1)
                                <input type="text"  value="Categorie" class="form-control">
                              @elseif($section->section_type==2)
                                <input type="text"  value="Sub-Categorie" class="form-control">
                              @elseif($section->section_type==3)
                                <input type="text"  value="Product" disabled="true" class="form-control">
                              @elseif($section->section_type==0)
                                <input type="text"  value="None" disabled="true" class="form-control">
                              @endif
                                <input type="hidden" id="section_type" value="{{$section->section_type}}" disabled="true" class="form-control">
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Categorie's</label>
                          <select name="city" id="select1" class="form-control">
                              <option disabled selected>Select Category</option>
                                @foreach($parentCategory as $index => $category)
                                  <option value="{{$category->cat_id}}"> {{$category->title}} </option>
                                @endforeach
                         </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Sub-Categorie's</label>
                          <select name="city" class="form-control" id="select2">
                              <option disabled selected>Select Sub-Category</option>
                                @foreach($categories as $index => $row)
                                  <option value="{{$row->cat_id}}" data-subcat="{{$row->parent}}" > {{$row->title}} </option>
                                @endforeach
                         </select>
                        </div>
                      </div>
                    </div>
                   
                    <br>












                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Product's</label>
                            
                            <ul id="allproductshere" >
                              
                            </ul>

                        </div>
                      </div>
                    </div>











                   
                     
                    <button type="submit" class="btn btn-primary pull-center">Submit</button>
                     <a href="{{route('storeclist')}}" class="btn">Close</a>
                    <div class="clearfix"></div>
                  
                </form>
                </div>
              </div>
            </div>
		      </div>
        </div>
      </div>  

    <script type="text/javascript">
    
      $(function(){

          $('#select2').change(function(){
            
            var cat = $('#select1').val();
            var subCat = $('#select2').val();
            $("#allproductshere").empty();
            
            jQuery.ajax({
              url: "{{ route('get.category.product') }}",
              method: 'post',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                 cat: cat,
                 subCat: subCat
              },
              success: function(result){
                // console.log(result);

                if(result.status == 200){
                  var toAppend = '';
                    console.log(result.data);
                    $.each(result.data, function(i,o){
                       toAppend += '<li onclick="getContent('+o.product_id+')" >'+ o.product_name +'<input type="checkbox" value="1" ></li>';
                    });

                    $('#allproductshere').append(toAppend);

                }

              }});
          });
      });


      $("#select1").change(function() {
        
        if ($(this).data('options') === undefined) {
          /*Taking an array of all options-2 and kind of embedding it on the select1*/
          $(this).data('options', $('#select2 option').clone());
        }
        var id = $(this).val();
        var options = $(this).data('options').filter('[data-subcat=' + id + ']');
        $('#select2').html(options);
      });


      function getContent(productId){

            if(product_id==''){
              alert('Something went Wrong');
            }else{

              
              var product_id = productId;
              var section_id = $('#section_id').val();
              var section_type = $('#section_type').val();

              jQuery.ajax({

                  url: "{{ route('save.content.to.section') }}",
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

                      alert('hohohohohoh');

                    }

                }});



            }
            
      }


    </script>
@endsection