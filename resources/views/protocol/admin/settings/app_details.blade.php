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
                  <h4 class="card-title">App Name | Site Logo | Favicon | Country code</h4>
                  <form class="forms-sample" action="{{route('updateappdetails')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                </div>
                <div class="card-body">
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">App Name</label>
                          <input type="text"name="app_name" value="{{($logo->name)}}" class="form-control">
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Country Code</label>
                          <input type="text"name="country_code" value="{{($cc->country_code)}}" class="form-control">
                        </div>
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <img src="{{url($logo->icon)}}" alt="app logo" class="rounded-circle" style="width:100px; height:100px;">
                        <div class="form">
                          <label class="bmd-label-floating">Site Logo</label>
                          <input type="file"name="app_icon" class="form-control">
                        </div>
                      </div>
                     <div class="col-md-6">
                        <img src="{{url($logo->favicon)}}" alt="app logo" class="rounded-circle" style="width:100px; height:100px;">
                        <div class="form">
                          <label class="bmd-label-floating">Web Favicon</label>
                          <input type="file" name="favicon" class="form-control">
                        </div>
                      </div>
                    </div>
                     <div class="row">
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Primary Color</label>
                          <input type="color" name="primary_color" value="{{($logo->primary_color)}}" class="form-control">
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Secondary Color</label>
                          <input type="color" name="secondary_color" value="{{($logo->secondary_color)}}" class="form-control">
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Topbar Color</label>
                          <input type="color" name="topbar_color" value="{{($logo->topbar_color)}}" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Splashscreen Color</label>
                          <input type="color" name="splashscreen_color" value="{{($logo->splashscreen_color)}}" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Button Color</label>
                          <input type="color" name="button_color" value="{{($logo->button_color)}}" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Font Family</label>
                          <select name="font_family" value="{{($logo->font_family)}}" class="font_family form-control"></select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Button Shapes</label>
                          <select name="button_shapes" value="{{($logo->button_shapes)}}" class="form-control">
                            <option value=""> --Select-- </option>
                            <option value="1" @if($logo->button_shapes==1) selected @endif >Rectangle</option>
                            <option value="2" @if($logo->button_shapes==2) selected @endif >Curve</option>
                            <option value="3" @if($logo->button_shapes==3) selected @endif >Round Corner</option>
                            </select>
                        </div>
                      </div>
                      <input type="hidden" name="store_id" value="0">
                   </div>
                    <button type="submit" class="btn btn-primary pull-center">Submit</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            
                <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Currency</h4>
                  <form class="forms-sample" action="{{route('updatecurrency')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                </div>
                <div class="card-body">
 
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Currency Name</label>
                          <input type="text" name="currency_name" value="{{($currency->currency_name)}}" class="form-control">
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Currency Sign</label>
                          <input type="text" name="currency_sign" value="{{($currency->currency_sign)}}" class="form-control">
                        </div>
                      </div>

                    </div>
                    <button type="submit" class="btn btn-primary pull-center">Submit</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
             
            </div>
			</div>
          </div>
<script type="text/javascript">
  var json = $.getJSON('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBwIX97bVWr3-6AIUvGkcNnmFgirefZ6Sw', function(data) {
  $.each( data.items, function( index, font ) {
    $('.font_family').append( $('<option></option>').attr('value', font.family).text(font.family) );
    $('.google-fonts').append("'" + font.family + "' => array('title' => '" + font.family + "'),<br>")
  });
});
</script>
@endsection




