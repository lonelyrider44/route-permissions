@extends('route_permissions::layout')

@section('content')
<div class="container-fluid">
    <div class="form-group row">
        @foreach($groups as $g)
        <div class="col-md-2 permission-group" id="{{$g->id}}">
            <b>{{$group->name}}</b>
            <div id="options-{{$g->id}}">
                @foreach($group->permissions as $p)
                <div class='col-md-12 form-check' name="div{{ $p->name }}">
                    <input class='form-check-input' type='checkbox' id='permission{{$p->id}}'
                        name='{{$p->name}}' value='{{$p->name}}'
                        @if($group->group_permissions->where('permission_id',$p->id)->isNotEmpty()) checked @endif >
                    <span style='margin-left:10px'>{{ $p->name}}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
        <div class="col-md-2 permission-group" id="ostalo">
            <b>Ostale permisije</b>
            <div id="ostaloOptions">
                @foreach($permissions_ungrouped as $p)
                <div class='col-md-12 form-check' name="div{{ $p->name }}">
                    <input class='form-check-input' type='checkbox' id='permission{{$p->id}}'
                        name='{{$p->name}}' value='{{$p->name}}'>
                    <span style='margin-left:10px'>{{ $p->name}}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection