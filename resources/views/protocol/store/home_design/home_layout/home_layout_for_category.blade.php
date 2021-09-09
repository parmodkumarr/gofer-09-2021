@extends('protocol.store.layout.app')
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
                  <form class="forms-sample" action="{{route('home.layout.form.add.category')}}"  method="post" enctype="multipart/form-data" >
                      {{csrf_field()}}

                    <div class="row">
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Section Type Name</label>
                          <input type="text" disabled="true" class="form-control" value="{{$sectionTypeDetail->name}}" >
                          <input type="hidden" name="section_type" value="{{$sectionTypeDetail->id}}">
                          
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">View Type</label>
                          <select name="view_type" class="form-control" >
                              <option selected="true" disabled="true" > Please Select </option>
                              <option value="list" @if(isset($ifAvailableLayout)) @if( $ifAvailableLayout->view_type == "list" ) selected="true" @endif @endif> Linear View </option>
                              <option value="grid" @if(isset($ifAvailableLayout)) @if( $ifAvailableLayout->view_type == "grid" ) selected="true" @endif @endif > Grid View </option>
                          </select>
                        </div>
                      </div>

                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">App Layout Design</label>
                          <select name="app_layout_design" class="form-control" >
                                <option disabled="true" selected="true" > Please Select </option>
                                @if(count($appLayoutTypes)>0)
                                  @foreach($appLayoutTypes as $index => $row)
                                      <option  value="{{$row->app_layout_value}}" @if(isset($ifAvailableLayout)) @if( $row->app_layout_value == $ifAvailableLayout->app_layout_design ) selected="true" @endif @endif > {{ $row->name }} </option>
                                  @endforeach
                                @endif
                          </select>
                        </div>
                      </div>
                    </div>


                    <div class="row" >
                      <div class="col-md-12">
                        <h3>Background</h3>
                      </div>
                    </div>

                    <!-- <div class="row" >
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Is Background</label>
                          <select name="is_background" id="is_background" class="form-control" >
                            <option selected="true" disabled="true" >Please Select</option>
                            <option value="1" onclick="efresponse(1)" >Yes</option>
                            <option value="0" onclick="efresponse(0)" >No</option>
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
                    </div> -->

                    <br>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form">
                          <label class="bmd-label-floating">Background Picture</label>
                          <input type="file"name="image" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Background Color</label>
                          <input type="color" name="color" value="@if(isset($ifAvailableLayout)) {{$ifAvailableLayout->color}} @endif" class="form-control">
                          <input type="hidden" name="store_id" value="@if($store) {{$store->store_id}} @endif">
                          <input type="hidden" name="home_section_id" value="{{$section_id}}" >
                          <input type="hidden" name="id" value="{{$layout_id}}" >
                        </div>
                      </div>
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary pull-center">Submit</button>
                     <a href="{{route('store.edit.section',$section_id)}}" class="btn">Close</a>
                    <div class="clearfix"></div>
                  
                </div>
              </div>
            </div>
			</div>
          </div>
          </form>


@endsection 


