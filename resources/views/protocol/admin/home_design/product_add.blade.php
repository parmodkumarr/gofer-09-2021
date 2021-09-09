<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
@extends('protocol.admin.layout.app')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
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

                  <div class="row">
                      <div class="col-md-12 ">
                        <button type="button" class="btn pull-right btn-primary" ><a href="{{route('admin.home.layout.form.view.category',$section->id)}}" style="color: white;" >Add Layout</a></button>
                      </div>
                  </div>
                  <br>
                  <form class="forms-sample" action="{{route('update.section')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Section Name</label>
                          <input type="text" value="{{$section->name}}" name="section_name" class="form-control">
                          <input type="hidden" value="{{$section->id}}" name="section_id" id="section_id" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
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
                      <div class="col-md-4">
                        <img src="{{url($section->image)}}" alt="image" name="old_image" style="width:100px;height:100px; border-radius:50%">
                        <div class="form-control">
                          <label class="bmd-label-floating">Section Image</label>
                          <input type="file" name="image" class="form-control">
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Categorie's</label>
                          <select name="category" id="select1" class="form-control select2">
                              <option disabled selected>Select Category</option>
                                @foreach($parentCategory as $index => $category)
                                  <option value="{{$category->cat_id}}"> {{$category->title}} </option>
                                @endforeach
                         </select>
                        </div>
                      </div>
 
                      <div class="col-md-6"  >
                        <div class="form-group">
                          <label class="bmd-label-floating">Sub-Categorie's</label>
                            <select data-placeholder="Begin typing a name to filter..." multiple class="select2" name="categoryIds[]" id="select2" style="width:100%">
                              {{-- 
                                @foreach($categories as $index => $row)
                                  <option style="display: none;" class="{{$row->parent}}" value="{{$row->cat_id}}" data-subcat="{{$row->parent}}" > {{$row->title}} </option>
                                @endforeach
                              --}}
                            </select>
                            &nbsp&nbsp
                        </div>
                      </div>
                    </div>
                    <br>
                    <a href="javascript:void(0)" onclick="storeCategoryId($('#select2').val())" style=" font-weight: 900; font-size: larger; " > Search </a>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">All Selected Product's</label>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Product ( {{count($confirmedEntries)}} )</button>
                    </div>
                  </div>
                </div>

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
                     <a href="{{route('storeclist')}}" class="btn">Close</a>
                    <div class="clearfix"></div>
                  
                </form>
                </div>
              </div>
            </div>
		      </div>
        </div>
      </div>  

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">New Section</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                      
                          <table class="display" id="myTable2">
                              <thead>
                                  <tr>
                                      <th class="text-center">#</th>
                                      <th>Image</th>
                                      <th>Category Name</th>
                                      <th>Category ID</th>
                                      <th class="text-right">status</th>
                                  </tr>
                              </thead>
                              <tbody id="allProductsList" >
                                @if( count($confirmedEntries) > 0 )
                                  @foreach( $confirmedEntries as $index => $row )
                                  @if(count($row) >0)
                                    <tr>
                                      <td class="text-center">{{$index+1}}</td>
                                      <td><img src="{{url('')}}/{{$row[0]->product_image}}" alt="category image" style="width:50px; height:50px; border-radius:50%;"/></td>
                                      <td>{{ $row[0]->product_name }}</td>
                                      <td>{{$row[0]->product_id}}</td>
                                      <td onclick="getContent('{{$row[0]->product_id}}')" ><input @if( in_array($row[0]->product_id,$confirmed) ) checked="true" @endif type="checkbox" ></td>              
                                    </tr>
                                  @endif 
                                  @endforeach
                                @endif
                              </tbody>
                            </table>
                          </div>
                        </div>
                </div>
              </div>
            </div>
          </div>










<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>

    <script type="text/javascript">

      //   $(".chosen-select").chosen({
      //   no_results_text: "Oops, nothing found!"
      // })
// function refreshsubcate(){
//   $("#select2").chosen()
// }

  function storeCategoryId(id){
        
          var cat = $('#select1').val();
          var subCat = id;

          //$("#allproductshere").empty();
          
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
                var check = '';
                var arrayFromPHP = <?php echo json_encode($confirmed); ?>;

                  console.log(arrayFromPHP);
                  $.each(result.data, function(i,o){
                    // console.log(o);
                    check = arrayCheck(o.product_id,arrayFromPHP);
                      var ii = i+1;
                    toAppend +=   '<tr ><td class="text-center">'+ii+'</td><td><img src="'+o.product_image+'" alt="category image" style="width:50px; height:50px; border-radius:50%;"/></td><td>'+o.product_name+'</td><td>'+o.product_id+'</td><td onclick="getContent('+o.product_id+')" ><input '+check+' type="checkbox" ></td></tr>';
                      check = "";
                  });

                  $('#allproductshere').html(toAppend);

              }

            }});
      }

      // $(function(){

      //     $('#select2').change(function(){
            
      //       var cat = $('#select1').val();
      //       var subCat = $('#select2').val();
      //       $("#allproductshere").empty();
            
      //       jQuery.ajax({
      //         url: "{{ route('get.category.product') }}",
      //         method: 'post',
      //         headers: {
      //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //         },
      //         data: {
      //            cat: cat,
      //            subCat: subCat
      //         },
      //         success: function(result){
      //           // console.log(result);

      //           if(result.status == 200){
      //             var toAppend = '';
      //             var check = '';
      //             var arrayFromPHP = <?php echo json_encode($confirmed); ?>;

      //               console.log(arrayFromPHP);
      //               $.each(result.data, function(i,o){
      //                 // console.log(o);
      //                 check = arrayCheck(o.product_id,arrayFromPHP);
                        
      //                 toAppend +=   '<tr ><td class="text-center">1</td><td><img src="'+o.product_image+'" alt="category image" style="width:50px; height:50px; border-radius:50%;"/></td><td>'+o.product_name+'</td><td>'+o.product_id+'</td><td onclick="getContent('+o.product_id+')" ><input '+check+' type="checkbox" ></td></tr>';
      //                   check = "";
      //               });

      //               $('#allproductshere').append(toAppend);

      //           }

      //         }});
      //     });
      // });




      function arrayCheck(a,arr){
          for(var i=0; i<arr.length; i++){
            var name = arr[i];
            if(name == a){
              status = 'checked';
              break;
            }else{
              status = '';
            }
          }
          return status;
      }


$(function(){
      $("#select1").change(function() {
        var cate =[]; 
        cate.push($(this).val());
              jQuery.ajax({

                  url: "{{ route('get.sub.categories') }}",
                  method: 'post',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data: {
                     cat: cate
                  },
                  success: function(result){
                    var html ='<option disabled="">Select Category</option>';
                    if(result.status == 200){
                      var option = result.data;
                      $.each(option, function( index, value ) {
                          html +="<option data-subcat='"+value.parent+"' class='"+value.parent+"' value='"+value.cat_id+"' >"+value.title+"</option>";
                      });
                      $('#select2').html(html);
                    }
                }});

      });

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

                      // alert('hohohohohoh');

                    }
                }});
            }
      }



    $(document).ready(function() {
      $('#myTable').DataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false });
    });


    $(document).ready(function() {
      $('#myTable2').DataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false });
    });

    </script>

@endsection