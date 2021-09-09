<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
@extends('protocol.admin.layout.app')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<style type="text/css">
  .chosen-container-multi .chosen-choices li.search-field input[type=text] {
 width: 100% !important;
}
.chosen-container {
   width: 200px !important;
}
</style>
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
                        <button type="button" class="btn pull-right btn-primary" ><a href="{{route('admin.home.layout.form.view.sub.category',$section->id)}}" style="color: white;" >Add Layout</a></button>
                      </div>
                  </div>
                  <br>
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
                      <div class="col-md-6">
                        <img src="{{url($section->image)}}" alt="image" name="old_image" style="width:100px;height:100px; border-radius:50%">
                        <div class="form-control">
                          <label class="bmd-label-floating">Section Image</label>
                          <input type="file" name="image" class="form-control">
                        </div>
                      </div>
                    </div>
                    


                    <div class="row" style="display: none;" >
                      <div class="col-md-12">
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
                    </div>              
                    <br>
                    <!-- hehehehehehe -->
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">All Selected Sub-Categories</label><br>
                            <select data-placeholder="Begin typing a name to filter..." multiple class="select2" name="categoryIds[]" id="allSelectedValues" style="width:100%">
                                  @foreach($parentCategory as $index => $category)
                                    <option value="{{$category->cat_id}}" @if( in_array($category->cat_id, $parentCatIds) ) selected="" @endif > {{$category->title}} </option>
                                  @endforeach
                            </select>
                            <br>
                            <br>
                            <a href="javascript:void(0)" onclick="storeCategoryId($(allSelectedValues).val())" id="onloadClick" style=" font-weight: 900; font-size: larger; " > Search </a>
                            
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">All Selected Sub-Categories</label>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Sub Categories ( {{count($confirmedEntries)}} )</button>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Sub Categories</label>
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
                                    <tr>
                                      <td class="text-center">{{$index+1}}</td>
                                      <td><img src="{{url('')}}/{{$row[0]->image}}" alt="category image" style="width:50px; height:50px; border-radius:50%;"/></td>
                                      <td>{{$row[0]->title}}</td>
                                      <td>{{$row[0]->cat_id}}</td>
                                      <td onclick="getContent('{{$row[0]->cat_id}}')" ><input @if( in_array($row[0]->cat_id,$confirmed) ) checked="true" @endif type="checkbox" ></td>              
                                    </tr>
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
      function storeCategoryId(id){
                    // $('#select1').change(function(){
            
            var cat = id;
            var check = '';
            var arrayFromPHP = <?php echo json_encode($confirmed); ?>;

            $("#allproductshere").empty();
            
            jQuery.ajax({
              url: "{{ route('get.sub.categories') }}",
              method: 'post',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                 cat: cat
              },
              success: function(result){
                // console.log(result);

                if(result.status == 200){
                  var toAppend = '';
                    // console.log(result.data);
                    $.each(result.data, function(i,o){
                      // console.log(o); 
                      check = arrayCheck(o.cat_id,arrayFromPHP);
                      var ii =i+1;
                      toAppend +=   '<tr ><td class="text-center">'+ii+'</td><td><img src="'+o.image+'" alt="category image" style="width:50px; height:50px; border-radius:50%;"/></td><td>'+o.title+'</td><td>'+o.cat_id+'</td><td onclick="getContent('+o.cat_id+')" ><input '+check+' type="checkbox" ></td></tr>';

                    });

                    $('#allproductshere').append(toAppend);

                }

              }});
          // });

      }


      $(".chosen-select").chosen({
        no_results_text: "Oops, nothing found!"
      })
    
      $(function(){

          $('#select1').change(function(){
            
            var cat = $('#select1').val();
            var check = '';
            var arrayFromPHP = <?php echo json_encode($confirmed); ?>;

            $("#allproductshere").empty();
            
            jQuery.ajax({
              url: "{{ route('get.sub.category') }}",
              method: 'post',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                 cat: cat
              },
              success: function(result){
                // console.log(result);

                if(result.status == 200){
                  var toAppend = '';
                    // console.log(result.data);
                    $.each(result.data, function(i,o){
                      // console.log(o); 
                      check = arrayCheck(o.cat_id,arrayFromPHP);

                      toAppend +=   '<tr ><td class="text-center">1</td><td><img src="'+o.image+'" alt="category image" style="width:50px; height:50px; border-radius:50%;"/></td><td>'+o.title+'</td><td>'+o.cat_id+'</td><td onclick="getContent('+o.cat_id+')" ><input '+check+' type="checkbox" ></td></tr>';

                    });

                    $('#allproductshere').append(toAppend);

                }

              }});
          });
      });

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



$('body').on('submit', '#postAllSelectedIds', function(e) {
  e.preventDefault();
});

      function getContent(productId){

            if(product_id==''){
              alert('Something went Wrong');
            }else{

              
              var product_id = productId;
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

    $(document).ready(function() {
      $('#onloadClick').click();
      // alert("document ready occurred!");
    });


    </script>
@endsection