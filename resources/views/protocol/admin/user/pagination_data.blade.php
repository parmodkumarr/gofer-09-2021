<div class="table-responsive">
    <table  class="table table-striped table-bordered" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th>User_name</th>
                <th>User Phone</th>
                <th>User Email</th>
                <th>Registeration Date</th>
                <th>Is Verified</th>
                <th>Active/Block/Delete</th>
            </tr>
        </thead>
        <tbody>
            @if(count($users)>0)
            @php $i=1; @endphp
            @foreach($users as $user)
            <tr>
                <td class="text-center">#{{$user->user_id}}</td>
                <td>{{$user->user_name}}</td>
                <td>{{$user->user_phone}}</td>
                <td>{{$user->user_email}}</td>
                <td>{{$user->reg_date}}</td>
                @if($user->is_verified==0)
                <td style="color:red">Not Verified</td>
                @else
                <td style="color:green">Verified</td>
                @endif
                
                   
                <td class="td-actions text-right">
                     @if($user->block==1)
                   <a href="{{route('userunblock',$user->user_id)}}" rel="tooltip" class="btn btn-danger">
                        <i class="material-icons">block</i>Blocked
                    </a>
                    @else
                    <a href="{{route('userblock',$user->user_id)}}" rel="tooltip" class="btn btn-primary">
                        <i class="material-icons">check</i>Active
                    </a>
                    @endif
                     <a href="{{route('del_userfromlist',$user->user_id)}}" rel="tooltip" onclick="return confirm('Are You sure! It will remove all the addresses & orders related to this User.')" class="btn btn-danger">
                        <i class="material-icons">delete_forever</i>Delete
                    </a>
                </td>
            </tr>
            @php $i++; @endphp
            @endforeach
              @else
                <tr>
                  <td>No data found</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center paginationLinks">
        {!! $users->links() !!}
    </div>
</div>