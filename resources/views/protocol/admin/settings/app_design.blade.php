@extends('protocol.admin.layout.app')
<style>
    .col-md-6{
        float:left !important;
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
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">App Design Setting</h4>
                  <form class="forms-sample" action="{{route('post_app_design')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                </div>
                <div class="card-body">
                    <div class="row">
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Primary Color</label>
                          <input type="text" name="primary_color" value="" class="form-control">
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Secondary Color</label>
                          <input type="text" name="secondary_color" value="" class="form-control">
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Topbar Color</label>
                          <input type="text" name="topbar_color" value="" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Splashscreen Color</label>
                          <input type="text" name="splashscreen_color" value="" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Button Color</label>
                          <input type="text" name="button_color" value="" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Font Family</label>
                          <input type="text" name="font_family" value="" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Button Shapes</label>
                          <input type="text" name="button_shapes" value="" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Logo</label>
                          <input type="file" name="logo" class="form-control">
                        </div>
                      </div>
                      <input type="hidden" name="store_id" value="0">
                   </div>
                   <div class="row">
                   	<div class="col-md-6">
                   		<button type="submit" class="btn btn-primary pull-center">Submit</button>
                   	</div>
                   </div>
                </div>
            </div>
		</div>
    </div>
@endsection