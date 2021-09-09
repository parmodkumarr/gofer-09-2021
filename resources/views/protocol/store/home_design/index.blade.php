@extends('protocol.store.layout.app')
<style type="text/css">
.image-parent {
  max-width: 40px;
}
.grey {
  color: grey;
}
.purple {
  color: #3f3fc7;
}
.flex {
  display: flex;
}
.flex-column {
  flex-direction: column;
}
.justify-center {
  justify-content: center;
}
.justify-flex-start {
  justify-content: flex-start;
}
.align-center {
  align-items: center;
}
.container {
    background: white;
    border-radius: 26px;
    
}
.product {
  width: 203.33px;
  height: 200px;
  padding: 25px;
  border-radius: 5px;
}
.product .description h4 {
  letter-spacing: 3px;
}
.product .description p {
  font-size: 11px;
  text-align: center;
}
.product .description .price strong {
  font-size: 200%;
}
.product .description .price sup {
  vertical-align: top;
}
.product:hover {
  background-color: #f0f3f7;
  cursor: pointer;
}

.select-this {
  background-color: #f0f3f7;
  cursor: pointer;
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
                  <h4 class="card-title">Home Design</h4>
                </div>

                  <form class="forms-sample" action="{{route('updateappdetails')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="card-body">
 

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group pull-right">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Add New</button>
                        </div>
                      </div>

                    </div>


                    <div class="row">
                      <div class="col-md-2"></div>
                        <div class="col-md-8">
                          <div class="form-group">
                            
                                  <ul class="list-group">
                                    
                                    @foreach($designs as $row)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                      <a href="{{route('store.edit.section',$row->id)}}" >{{$row->name}}</a>
                                      <div class="">
                                      </div>
                                      <div class="">
                                        @if($row->is_active==1)
                                        <a style="color:green; font-size: larger;" href="{{route('store.toggle.section.status',$row->id)}}" > {{__('Visible')}} </a>
                                        @elseif($row->is_active==0)
                                        <a style="color:red; font-size: larger;" href="{{route('store.toggle.section.status',$row->id)}}" > {{__('Hidden')}} </a>
                                        @endif
                                      </div>
                                      
                                      <div class="">
                                          <p> {{$row->section_type_name}} </p>
                                      </div>
                                      <div class="image-parent">
                                          <img src="{{url($row->image)}}" class="img-fluid" alt="quixote">
                                      </div>
                                      <div class="">
                                          <a class="btn btn-danger __delete" href="javascript:void(0)" data-route="{{route('store.deletehomeDesign')}}" data-id="{{$row->id}}" data-heading="Are you sure?" data-message="you want to permanently delete this item">Delete</a>
                                      </div>
                                    </li>
                                    @endforeach
                                    
                                  </ul>

                        </div>
                      </div>
                    <div class="col-md-2"></div>
                  </div>


                    <!-- <button type="submit" class="btn btn-primary pull-right">Submit Order</button> -->
                    <div class="clearfix"></div>


                  </form>
                </div>
              </div>
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




                  <div class="container flex align-center justify-center set-section-type">
                    <div class="product flex flex-column align-center justify-flex-start section-type-category ">
                      <div class="image flex flex-column justify-center align-center">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                          width="75px" height="75px" viewBox="0 0 32 32" enable-background="new 0 0 32 32" xml:space="preserve">
                        <rect x="12" y="8" fill="#FFD561" width="1" height="14"/>
                        <rect x="10" y="8" fill="#FFD561" width="1" height="14"/>
                        <path fill="#FFD561" d="M14,8v14h14V10c0,0-1-2-2-2H14z"/>
                        <g>
                          <path fill="#2D2220" d="M28.5,6h-25C2.67,6,2,6.67,2,7.5v16C2,24.33,2.67,25,3.5,25H15v2h-5v1h12v-1h-5v-2h11.5
                            c0.83,0,1.5-0.67,1.5-1.5v-16C30,6.67,29.33,6,28.5,6z M29,21H6v1h23v1.5c0,0.28-0.22,0.5-0.5,0.5h-25C3.22,24,3,23.78,3,23.5v-16
                            C3,7.22,3.22,7,3.5,7h25C28.78,7,29,7.22,29,7.5V21z"/>
                        </g>
                        <g>
                          <path fill="#2D2220" d="M28,9.5v10h-1v-10c0-0.4-0.28-0.49-0.51-0.5H5.5C5.1,9,5.01,9.27,5,9.51V22H4V9.5C4,8.9,4.4,8,5.5,8h21
                            C27.1,8,28,8.4,28,9.5z"/>
                        </g>
                        <rect x="11" y="28" fill="#FFD561" width="8" height="1"/>
                        <rect x="20" y="28" fill="#FFD561" width="3" height="1"/>
                        </svg>
                      </div>
                      <div class="description flex flex-column justify-center align-center grey">
                        <h4 class="purple"><strong>Categoriee's</strong></h4>
                        
                      </div>
                    </div>

                        <div class="product flex flex-column align-center justify-flex-start section-type-sub-category">
                      <div class="image flex flex-column justify-center align-center">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                          width="75px" height="75px" viewBox="0 0 32 32" enable-background="new 0 0 32 32" xml:space="preserve">
                        <rect x="12" y="8" fill="#FFD561" width="1" height="14"/>
                        <rect x="10" y="8" fill="#FFD561" width="1" height="14"/>
                        <path fill="#FFD561" d="M14,8v14h14V10c0,0-1-2-2-2H14z"/>
                        <g>
                          <path fill="#2D2220" d="M28.5,6h-25C2.67,6,2,6.67,2,7.5v16C2,24.33,2.67,25,3.5,25H15v2h-5v1h12v-1h-5v-2h11.5
                            c0.83,0,1.5-0.67,1.5-1.5v-16C30,6.67,29.33,6,28.5,6z M29,21H6v1h23v1.5c0,0.28-0.22,0.5-0.5,0.5h-25C3.22,24,3,23.78,3,23.5v-16
                            C3,7.22,3.22,7,3.5,7h25C28.78,7,29,7.22,29,7.5V21z"/>
                        </g>
                        <g>
                          <path fill="#2D2220" d="M28,9.5v10h-1v-10c0-0.4-0.28-0.49-0.51-0.5H5.5C5.1,9,5.01,9.27,5,9.51V22H4V9.5C4,8.9,4.4,8,5.5,8h21
                            C27.1,8,28,8.4,28,9.5z"/>
                        </g>
                        <rect x="11" y="28" fill="#FFD561" width="8" height="1"/>
                        <rect x="20" y="28" fill="#FFD561" width="3" height="1"/>
                        </svg>
                      </div>
                      <div class="description flex flex-column justify-center align-center grey">
                        <h4 class="purple"><strong>Sub-Categorie's</strong></h4>
                        
                      </div>
                    </div>

                        <div class="product flex flex-column align-center justify-flex-start section-type-product">
                      <div class="image flex flex-column justify-center align-center">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                          width="75px" height="75px" viewBox="0 0 32 32" enable-background="new 0 0 32 32" xml:space="preserve">
                        <rect x="12" y="8" fill="#FFD561" width="1" height="14"/>
                        <rect x="10" y="8" fill="#FFD561" width="1" height="14"/>
                        <path fill="#FFD561" d="M14,8v14h14V10c0,0-1-2-2-2H14z"/>
                        <g>
                          <path fill="#2D2220" d="M28.5,6h-25C2.67,6,2,6.67,2,7.5v16C2,24.33,2.67,25,3.5,25H15v2h-5v1h12v-1h-5v-2h11.5
                            c0.83,0,1.5-0.67,1.5-1.5v-16C30,6.67,29.33,6,28.5,6z M29,21H6v1h23v1.5c0,0.28-0.22,0.5-0.5,0.5h-25C3.22,24,3,23.78,3,23.5v-16
                            C3,7.22,3.22,7,3.5,7h25C28.78,7,29,7.22,29,7.5V21z"/>
                        </g>
                        <g>
                          <path fill="#2D2220" d="M28,9.5v10h-1v-10c0-0.4-0.28-0.49-0.51-0.5H5.5C5.1,9,5.01,9.27,5,9.51V22H4V9.5C4,8.9,4.4,8,5.5,8h21
                            C27.1,8,28,8.4,28,9.5z"/>
                        </g>
                        <rect x="11" y="28" fill="#FFD561" width="8" height="1"/>
                        <rect x="20" y="28" fill="#FFD561" width="3" height="1"/>
                        </svg>
                      </div>
                      <div class="description flex flex-column justify-center align-center grey">
                        <h4 class="purple"><strong>Product's</strong></h4>
                      </div>
                    </div>
                  </div>


                  <form action="{{route('create.section')}}" id="ajax-submit" class="section-creation-form" method="post" enctype="multipart/form-data" style="display: none;" >

                    <div class="col-lg-12 err-msg-name err" style="display: none;" >
                      <div class="alert alert-danger err-msg-here" role="alert">
                        Name field is required
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                      </div>
                    </div>
                    <div class="col-lg-12 err-msg-image err" style="display: none;" >
                      <div class="alert alert-danger err-msg-here" role="alert">
                        Image field is required
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                      </div>
                    </div>
                    <div class="col-lg-12 err-msg-is_banner err" style="display: none;" >
                      <div class="alert alert-danger err-msg-here" role="alert">
                        Is-Banner field is required
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                      </div>
                    </div>

                    

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Name</label>
                          <!-- <select name="name" class="form-control" id="name" >
                            @if(count($sectionTypes))
                              @foreach($sectionTypes as $index => $row)
                                <option value="{{$row->id}}" >{{$row->name}}</option>
                              @endforeach
                            @endif
                          </select> -->
                          <input type="text"name="name" id="name" value="" class="form-control">
                            <input type="hidden" name="section_type" id="section_type" value="" class="form-control">
                        </div>
                      </div>
                    </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form">
                            <label class="bmd-label-floating">Image</label>
                            <input type="file" accept="image/png, image/jpeg" name="image" id="image" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form">
                            <label class="bmd-label-floating">Is Banner</label>
                            <select class="form-control" name="is_banner" id="is_banner" >
                              <option value="0" selected="true" >No</option>
                              <option value="1" >Yes</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                      </div>
                  </form>




                </div>
              </div>
            </div>
          </div>



      <script>
      

      $(document).ready(function(){
          $('#ajax-submit').submit(function(e) {

              $('.err').hide();
              e.preventDefault();

              var name = $('#name').val();
              var image = $('#image').val();
              var section_type = $('#section_type').val();
              var is_banner = $('#is_banner').val();
              var token = $('meta[name="csrf-token"]').attr('content');

              if(name==''){

                  $('.err-msg-name').show();

              }else if(image==''){
                  $('.err-msg-image').show();
              }else if(is_banner==''){
                  $('.err-msg-is_banner').show();
              }else{
                

               jQuery.ajax({
                  url: "{{ route('store.create.section') }}",
                  method: 'post',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data: {
                     name: name,
                     image: image,
                     section_type: section_type,
                     is_banner: is_banner
                  },
                  success: function(result){

                    window.location.replace(result);
                  }});

              }
          });
      });


      $(document).ready(function(){
        $('.section-type-category').click(function(){
          putSectionType(1);
            $(".section-type-category").addClass("select-this");
           $(".section-type-sub-category").removeClass("select-this");
           $(".section-type-product").removeClass("select-this");
        });
        $('.section-type-sub-category').click(function(){
          putSectionType(2);
           $(".section-type-category").removeClass("select-this");
           $(".section-type-product").removeClass("select-this");
          $(".section-type-sub-category").addClass("select-this");
        });
        $('.section-type-product').click(function(){
          putSectionType(3);
           $(".section-type-sub-category").removeClass("select-this");
           $(".section-type-category").removeClass("select-this");
          $(".section-type-product").addClass("select-this");
        });

        function putSectionType(type){
          $('.section-creation-form').show();
          // $('.set-section-type').hide();
          $('#section_type').val(type);
        }

      });

      $('body').on('click', '.__delete', function(e) {
    e.preventDefault();
    var data_heading = $(this).attr('data-heading');
    var data_message = $(this).attr('data-message');
    var route = $(this).attr('data-route');
    var ID = $(this).attr('data-id');
    var option = { _token: $('meta[name="csrf-token"]').attr('content'),id:ID };
    swal({
      title: data_heading,
      text: data_message,
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false,
      closeOnCancel: false
    }).then( (isConfirm) => {
        if (!isConfirm.value) {return;}
        $.ajax({
          type: 'POST',
          url: route,
          data: option,
          success: function(data) {
            swal("Done!", "It was succesfully deleted!", "success");
            location.reload();
          },
          error: function(data) {
            swal("Error deleting!", "Please try again", "error");
          }
        });
      });
    
  });
      </script>

@endsection




