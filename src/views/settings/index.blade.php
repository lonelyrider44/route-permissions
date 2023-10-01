@extends('route_permissions::layout')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('crp.settings.publish')}}" class="btn btn-primary">Publish config</a>
        </div>
    </div>
</div>

@endsection