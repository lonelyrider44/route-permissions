<?php

namespace LR\Route\Permissions\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RoutePermission;
use App\Http\Requests\StoreRoutePermissionRequest;
use App\Http\Requests\UpdateRoutePermissionRequest;
use Illuminate\Http\Request;
use LR\Route\Permissions\Models\Group;
use LR\Route\Permissions\Models\GroupPermission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('route_permissions::role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('route_permissions::role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoutePermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create($request->all());

        return redirect()->route('crp.roles.permissions',$role);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoutePermission  $routePermission
     * @return \Illuminate\Http\Response
     */
    public function show(RoutePermission $routePermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoutePermission  $routePermission
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('route_permissions::role.edit',compact('role'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoutePermissionRequest  $request
     * @param  \App\Models\RoutePermission  $routePermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \Spatie\Permission\Models\Role $role)
    {
        $role->update($request->all());
        
        return redirect()->route('crp.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoutePermission  $routePermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoutePermission $routePermission)
    {
        //
    }

    public function show_permissions(Role $role){
        $groups = Group::all();
        $permissions = Permission::all();
        $permissions_ungrouped = Permission::whereNotIn('id',GroupPermission::select('permission_id'))->get();
        return view('route_permissions::role.permissions',compact('role','groups','permissions','permissions_ungrouped'));
    }
    public function update_permissions(Request $request, Role $role){

        $role->permissions()->sync($request->permissions);
        return redirect()->route('crp.roles.permissions',$role);

    }
}
