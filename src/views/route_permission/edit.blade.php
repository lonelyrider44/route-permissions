@extends('route_permissions::layout')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{route('crp.route-permissions.update',$routePermission)}}">
                @csrf @method('PATCH')
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Route</label>
                  <input type="text" class="form-control" id="route_name" name="route_name" aria-describedby="emailHelp" value="{{$routePermission->route_name}}" disabled>
                  {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Permission</label>
                  <input type="text" class="form-control" id="permission_name" name="permission_name" value="{{$routePermission->permission_name}}">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Group</label>
                  <input type="text" class="form-control" id="permission_group" name="permission_group" value="{{$routePermission->permission_group}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div>

@endsection