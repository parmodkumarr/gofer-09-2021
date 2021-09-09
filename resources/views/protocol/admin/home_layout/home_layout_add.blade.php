@extends('protocol.admin.layout.app')
<style type="text/css">
  
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
                  <h4 class="card-title">Create Layout</h4>
                </div>
                <div class="card-body">
                  <form class="forms-sample" action="{{route('admin.home.layout.form.add.category')}}"  method="post" enctype="multipart/form-data" >
                      {{csrf_field()}}


<!-- 
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Section Type Name</label>
                          <input type="text" name="name" class="form-control">
                        </div>
                      </div>
                    </div>
 -->



                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Section Type Name</label>
                          <select name="section_type" class="form-control" >
                                <option disabled="true" selected="true" > Please Select </option>
                                @if(count($sectionTypes)>0)
                                  @foreach($sectionTypes as $index => $type)
                                    <option value="{{$type->id}}" >{{$type->name}} </option>
                                  @endforeach
                                @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">View Type</label>
                          <select name="view_type" class="form-control" >
                                <option value="list" > List View </option>
                                <option value="grid" > Grid View </option>
                          </select>
                        </div>
                      </div>                       
                    </div>


                    <div class="row" >
                      <div class="col-md-12">
                        <h3>Background</h3>
                      </div>
                    </div>

                    <div class="row" >
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Is Background</label>
                          <select name="is_background" class="form-control" >
                            <option selected="true" disabled="true" >Please Select</option>
                            <option value="1" >Yes</option>
                            <option value="0" >No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Background Type</label>
                          <select name="background_type" class="form-control" >
                            <option selected="true" disabled="true" >Please Select</option>
                            <option value="picture" > Picture </option>
                            <option value="color" > Color </option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <br>

                    <div class="row" >
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Background Picture</label>
                          <!-- <input type="file" name="image" class="form-control"> -->
                          <input type="file" style="z-index: 0;" name="product_image" class="form-control">
                        </div>
                      </div>
                    </div>


                    <br>

                    <div class="row" >
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Background Color</label>
                          <input type="text" name="color" class="form-control">
                        </div>
                      </div>
                    </div>

                    <br>


                    
                    <button type="submit" class="btn btn-primary pull-center">Submit</button>
                     <a href="{{route('storeclist')}}" class="btn">Close</a>
                    <div class="clearfix"></div>
                  
                </div>
              </div>
            </div>
			</div>
          </div>
          </form>
@endsection 

