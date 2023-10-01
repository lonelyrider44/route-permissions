@extends('route_permissions::layout')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{route('crp.roles.store')}}">
                @csrf 
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Role name</label>
                  <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                  {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div>

@endsection