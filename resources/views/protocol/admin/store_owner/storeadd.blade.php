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
                  <h4 class="card-title">Store Owner Profile</h4>
                </div>
                <div class="card-body">
                  <form class="forms-sample" action="{{route('store.owner.added')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Store Owner Name</label>
                          <input type="text" name="name" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email Address</label>
                          <input type="text" name="email" class="form-control">
                        </div>
                      </div>
                       
                    </div>
                   <br>

                   <div class="row">
                      
                      
                     <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Phone</label>
                          <input type="test" name="phone" class="form-control">
                        </div>
                      </div>
                       
                     <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="test" name="password" class="form-control">
                        </div>
                      </div>
                                   
                    </div>


         
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

