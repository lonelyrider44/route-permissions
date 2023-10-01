<?php

namespace LR\Route\Permissions\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use LR\Route\Permissions\Models\Group;
use LR\Route\Permissions\Models\GroupPermission;
use LR\Route\Permissions\Requests\StoreGroupRequest;
use Spatie\Permission\Models\Permission;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("route_permissions::group.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("route_permissions::group.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePermissionGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        $group = Group::create($request->all());

        return redirect()->route('crp.groups.permissions',$group);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PermissionGroup  $permissionGroup
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PermissionGroup  $permissionGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view("route_permissions::group.edit",compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionGroupRequest  $request
     * @param  \App\Models\PermissionGroup  $permissionGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->all());

        return redirect()->route('crp.groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PermissionGroup  $permissionGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermissionGroup $permissionGroup)
    {
        //
    }

    public function show_permissions(Group $group){
        $groups = Group::all();
        $permissions = Permission::all();
        $permissions_ungrouped = Permission::whereNotIn('id',GroupPermission::select('permission_id'))->get();
        return view('route_permissions::group.permissions',compact('group','groups','permissions','permissions_ungrouped'));
    }
    public function update_permissions(Request $request, Group $group){

        $group->permissions()->sync($request->permissions);
        return redirect()->route('crp.group.permissions',$group);

    }
}
